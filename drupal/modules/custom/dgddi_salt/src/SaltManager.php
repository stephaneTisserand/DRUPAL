<?php

namespace Drupal\dgddi_salt;

/**
 * Class SaltManager.
 */
class SaltManager
{
  const QUERY_NAME_API_CODE   = "secAppelant";
  const QUERY_NAME_TIMESTAMP  = "secTimestamp";
  const QUERY_NAME_SIGNATURE  = "secSignature";

  protected $defaultURL;

  private $apiCode;
  private $apiPassword;
  private $salt;
  private $encryptedKey;

  /**
   * Class constructor.
   *
   * @param string $apiCode
   * @param string $apiPassword
   * @param string $salt
   * @param string $defaultURL
   */
  public function __construct($apiCode, $apiPassword, $salt, $defaultURL) {
    $this->apiCode      = $apiCode;
    $this->apiPassword  = $apiPassword;
    $this->salt         = $salt;
    $this->defaultURL   = $defaultURL;

    $this->encryptedKey = $this->encrypteKey($apiPassword);
  }

  /**
   * Get DefaultURL
   *
   * @return string
   */
  public function getDefaultURL() {
    return $this->defaultURL;
  }
  
  /**
   * Encode an URL
   *
   * @param string $url
   *
   * @return string $encodedURL
   */
  public function encode($url) {
    // Add QUERY_NAME_API_CODE and QUERY_NAME_TIMESTAMP query parameters
    $parsedUrl = parse_url($url);
    $parsedUrl['query'] = isset($parsedUrl['query']) ? $parsedUrl['query'] : array();

    $mt = explode(' ', microtime());
    $microtime = $mt[1] . substr($mt[0], 2, 7);

    $url = $this->appendParameters($parsedUrl, array(
      self::QUERY_NAME_API_CODE   => $this->apiCode,
      self::QUERY_NAME_TIMESTAMP  => $microtime
    ));

    // Add QUERY_NAME_SIGNATURE query parameter
    $parsedUrl = parse_url($url);
    $formattedSignature = $this->formatSignature($parsedUrl);
    return  $this->appendParameters($parsedUrl, array(
      self::QUERY_NAME_SIGNATURE  => $formattedSignature
    ));
  }


  /**
   * Append/Replace Query parameter(s)
   *
   * @param array $parsedUrl
   * @param array $newParameters
   *
   * @return string $url
   */
  public function appendParameters($parsedUrl, $newParameters) {
    $parameters = $this->http_parse_query($parsedUrl['query']);
    foreach ($newParameters as $key => $value) {
      $parameters[$key] = $value;
    }
    $parsedUrl['query'] = http_build_query($parameters);

    return $this->rebuild_url($parsedUrl);
  }

  /**
   * Parse Query to parameters array
   *
   * @param string $query
   *
   * @return array $parameters
   */
  public function http_parse_query($query) {
    $parameters = array();
    $queryParts = explode('&', $query);
    foreach ($queryParts as $queryPart) {
      $keyValue = explode('=', $queryPart, 2);
      $parameters[$keyValue[0]] = $keyValue[1];
    }

    return $parameters;
  }

  /**
   * Rebuild URL from parsed array
   *
   * @param array $parts
   *
   * @return string
   */
  public function rebuild_url(array $parts) {
    return (isset($parts['scheme']) ? "{$parts['scheme']}:" : '') .
    ((isset($parts['user']) || isset($parts['host'])) ? '//' : '') .
    (isset($parts['user']) ? "{$parts['user']}" : '') .
    (isset($parts['pass']) ? ":{$parts['pass']}" : '') .
    (isset($parts['user']) ? '@' : '') .
    (isset($parts['host']) ? "{$parts['host']}" : '') .
    (isset($parts['port']) ? ":{$parts['port']}" : '') .
    (isset($parts['path']) ? "{$parts['path']}" : '') .
    (isset($parts['query']) ? "?{$parts['query']}" : '') .
    (isset($parts['fragment']) ? "#{$parts['fragment']}" : '');
  }

  /**
   * Format Signature
   *
   * @param $parsedUrl
   *
   * @return string
   */
  public function formatSignature($parsedUrl) {
    // Get URI without the first slash
    $uri = substr($parsedUrl['path'] . '?' . $parsedUrl['query'], 1);

    // Encode Signature
    $signature = hash_hmac('sha256', $uri, $this->encryptedKey);
    $signature = $this->bytesEncrypted($signature);
    $signature = base64_encode($this->unbytes($signature));

    return str_replace(array('+', '/', '='), array('-', '_', ''), $signature);
  }

  /**
   * Encrypt Security Key
   *
   * @param string $key
   *
   * @return string
   */
  public function encrypteKey($key) {
    // Encrypt security Key
    $encryptedSecurityKey = $this->hash($key);
    $encryptedSecurityKey = $this->bytesEncrypted($encryptedSecurityKey);

    // Concat with salt & hash again
    $full = array_merge($encryptedSecurityKey, $this->bytes($this->salt));
    $dataFullAsString = $this->unbytes($full);
    $result = $this->hash($dataFullAsString, TRUE);

    return strtolower($result);
  }

  function bytesBin($binString) {

  }

  /**
   * Hash local function
   *
   * @param string $string
   * @param boolean $x1
   *
   * @return string
   */
  public function hash($string, $x1 = FALSE) {
    $string = hash('sha256', $string);

    if ($x1 === TRUE) {
      $bytearr = str_split($string, 2);
      $ret = '';
      foreach ($bytearr as $byte) {
        $ret .= ($byte[0] == '0') ? str_replace('0', '', $byte) : $byte;
      }

      return $ret;
    }

    return $string;
  }

  /**
   * Bytes local function
   *
   * @param string $string
   *
   * @return array
   */
  public function bytes($string) {
    return unpack('C*', $string);
  }

  /**
   * BytesEncrypted local function
   *
   * @param string $string
   *
   * @return array
   */
  public function bytesEncrypted($string) {
    $strlen = strlen($string) ;
    $hashedBytes = array() ;
    $i = 0 ;
    while ($i < $strlen) {
      $pair = substr($string, $i, 2) ;
      $hashedBytes[] = hexdec($pair) ;
      $i = $i + 2 ;
    }

    return $hashedBytes;
  }

  /**
   * Unbytes local function
   *
   * @param array $data
   *
   * @return string
   */
  public function unbytes($data) {
    $dataFullAsString = '';
    foreach ($data as $k => $v) {
      $dataFullAsString .= chr($v & 0xFF);
    }

    return $dataFullAsString;
  }
}
