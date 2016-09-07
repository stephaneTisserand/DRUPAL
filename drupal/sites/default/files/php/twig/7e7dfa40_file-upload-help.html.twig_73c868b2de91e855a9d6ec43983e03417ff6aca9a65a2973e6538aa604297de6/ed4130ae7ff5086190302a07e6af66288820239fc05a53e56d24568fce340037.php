<?php

/* core/themes/classy/templates/content-edit/file-upload-help.html.twig */
class __TwigTemplate_7f73c3304948c2d60db0171c26ec9d8445a4bb8437b6a25e444a096aeb5fe51c extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_7663a2b8523755a76a5be7fbc9384b1c764fa2990f975edfa0128995f1bf3500 = $this->env->getExtension("native_profiler");
        $__internal_7663a2b8523755a76a5be7fbc9384b1c764fa2990f975edfa0128995f1bf3500->enter($__internal_7663a2b8523755a76a5be7fbc9384b1c764fa2990f975edfa0128995f1bf3500_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "core/themes/classy/templates/content-edit/file-upload-help.html.twig"));

        $tags = array();
        $filters = array("safe_join" => 12);
        $functions = array();

        try {
            $this->env->getExtension('sandbox')->checkSecurity(
                array(),
                array('safe_join'),
                array()
            );
        } catch (Twig_Sandbox_SecurityError $e) {
            $e->setTemplateFile($this->getTemplateName());

            if ($e instanceof Twig_Sandbox_SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof Twig_Sandbox_SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof Twig_Sandbox_SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

        // line 12
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->renderVar($this->env->getExtension('drupal_core')->safeJoin($this->env, (isset($context["descriptions"]) ? $context["descriptions"] : null), "<br />")));
        echo "
";
        
        $__internal_7663a2b8523755a76a5be7fbc9384b1c764fa2990f975edfa0128995f1bf3500->leave($__internal_7663a2b8523755a76a5be7fbc9384b1c764fa2990f975edfa0128995f1bf3500_prof);

    }

    public function getTemplateName()
    {
        return "core/themes/classy/templates/content-edit/file-upload-help.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  46 => 12,);
    }
}
/* {#*/
/* /***/
/*  * @file*/
/*  * Theme override to display help text for file fields.*/
/*  **/
/*  * Available variables:*/
/*  * - descriptions: Lines of help text for uploading a file.*/
/*  **/
/*  * @see template_preprocess_file_upload_help()*/
/*  *//* */
/* #}*/
/* {{ descriptions|safe_join('<br />') }}*/
/* */
