<?php

/* core/themes/bartik/templates/form--search-block-form.html.twig */
class __TwigTemplate_f293f7b28c302f6d77829b45385785f75b46f88c04bc84d2d828cc25cca5b13a extends Twig_Template
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
        $__internal_098d4a3ffacf2a84a27307a353157076c9d1530f99a487e6e2859f166db4b491 = $this->env->getExtension("native_profiler");
        $__internal_098d4a3ffacf2a84a27307a353157076c9d1530f99a487e6e2859f166db4b491->enter($__internal_098d4a3ffacf2a84a27307a353157076c9d1530f99a487e6e2859f166db4b491_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "core/themes/bartik/templates/form--search-block-form.html.twig"));

        $tags = array();
        $filters = array();
        $functions = array();

        try {
            $this->env->getExtension('sandbox')->checkSecurity(
                array(),
                array(),
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

        // line 13
        echo "<form";
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute((isset($context["attributes"]) ? $context["attributes"] : null), "addClass", array(0 => "search-form", 1 => "search-block-form"), "method"), "html", null, true));
        echo ">
  ";
        // line 14
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["children"]) ? $context["children"] : null), "html", null, true));
        echo "
</form>
";
        
        $__internal_098d4a3ffacf2a84a27307a353157076c9d1530f99a487e6e2859f166db4b491->leave($__internal_098d4a3ffacf2a84a27307a353157076c9d1530f99a487e6e2859f166db4b491_prof);

    }

    public function getTemplateName()
    {
        return "core/themes/bartik/templates/form--search-block-form.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  51 => 14,  46 => 13,);
    }
}
/* {#*/
/* /***/
/*  * @file*/
/*  * Default theme implementation for a 'form' element.*/
/*  **/
/*  * Available variables:*/
/*  * - attributes: A list of HTML attributes for the wrapper element.*/
/*  * - children: The child elements of the form.*/
/*  **/
/*  * @see template_preprocess_form()*/
/*  *//* */
/* #}*/
/* <form{{ attributes.addClass('search-form', 'search-block-form') }}>*/
/*   {{ children }}*/
/* </form>*/
/* */
