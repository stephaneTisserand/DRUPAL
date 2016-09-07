<?php

/* core/themes/classy/templates/navigation/breadcrumb.html.twig */
class __TwigTemplate_e8157ba9e5b387467702d8af342bb27a72ab734d4916ca30779060f6eaf6b2d3 extends Twig_Template
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
        $__internal_f87e83a5ca0161116dc902605c0fb2c29ec4bc7baf2b3363f384957d84e7f9d9 = $this->env->getExtension("native_profiler");
        $__internal_f87e83a5ca0161116dc902605c0fb2c29ec4bc7baf2b3363f384957d84e7f9d9->enter($__internal_f87e83a5ca0161116dc902605c0fb2c29ec4bc7baf2b3363f384957d84e7f9d9_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "core/themes/classy/templates/navigation/breadcrumb.html.twig"));

        $tags = array("if" => 10, "for" => 14);
        $filters = array("t" => 12);
        $functions = array();

        try {
            $this->env->getExtension('sandbox')->checkSecurity(
                array('if', 'for'),
                array('t'),
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

        // line 10
        if ((isset($context["breadcrumb"]) ? $context["breadcrumb"] : null)) {
            // line 11
            echo "  <nav class=\"breadcrumb\" role=\"navigation\" aria-labelledby=\"system-breadcrumb\">
    <h2 id=\"system-breadcrumb\" class=\"visually-hidden\">";
            // line 12
            echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->renderVar(t("Breadcrumb")));
            echo "</h2>
    <ol>
    ";
            // line 14
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["breadcrumb"]) ? $context["breadcrumb"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 15
                echo "      <li>
        ";
                // line 16
                if ($this->getAttribute($context["item"], "url", array())) {
                    // line 17
                    echo "          <a href=\"";
                    echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute($context["item"], "url", array()), "html", null, true));
                    echo "\">";
                    echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute($context["item"], "text", array()), "html", null, true));
                    echo "</a>
        ";
                } else {
                    // line 19
                    echo "          ";
                    echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute($context["item"], "text", array()), "html", null, true));
                    echo "
        ";
                }
                // line 21
                echo "      </li>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 23
            echo "    </ol>
  </nav>
";
        }
        
        $__internal_f87e83a5ca0161116dc902605c0fb2c29ec4bc7baf2b3363f384957d84e7f9d9->leave($__internal_f87e83a5ca0161116dc902605c0fb2c29ec4bc7baf2b3363f384957d84e7f9d9_prof);

    }

    public function getTemplateName()
    {
        return "core/themes/classy/templates/navigation/breadcrumb.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  86 => 23,  79 => 21,  73 => 19,  65 => 17,  63 => 16,  60 => 15,  56 => 14,  51 => 12,  48 => 11,  46 => 10,);
    }
}
/* {#*/
/* /***/
/*  * @file*/
/*  * Theme override for a breadcrumb trail.*/
/*  **/
/*  * Available variables:*/
/*  * - breadcrumb: Breadcrumb trail items.*/
/*  *//* */
/* #}*/
/* {% if breadcrumb %}*/
/*   <nav class="breadcrumb" role="navigation" aria-labelledby="system-breadcrumb">*/
/*     <h2 id="system-breadcrumb" class="visually-hidden">{{ 'Breadcrumb'|t }}</h2>*/
/*     <ol>*/
/*     {% for item in breadcrumb %}*/
/*       <li>*/
/*         {% if item.url %}*/
/*           <a href="{{ item.url }}">{{ item.text }}</a>*/
/*         {% else %}*/
/*           {{ item.text }}*/
/*         {% endif %}*/
/*       </li>*/
/*     {% endfor %}*/
/*     </ol>*/
/*   </nav>*/
/* {% endif %}*/
/* */
