<?php

/* core/themes/seven/templates/block--local-actions-block.html.twig */
class __TwigTemplate_35c4ce03e3d25f66d2234d4adf745ddcc477c85affaba366e4b67a4e49a4b3a5 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@block/block.html.twig", "core/themes/seven/templates/block--local-actions-block.html.twig", 1);
        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@block/block.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_d763048ad6c2127da70531254822f675d53b951e3a4680fd317a78076c4ed4ad = $this->env->getExtension("native_profiler");
        $__internal_d763048ad6c2127da70531254822f675d53b951e3a4680fd317a78076c4ed4ad->enter($__internal_d763048ad6c2127da70531254822f675d53b951e3a4680fd317a78076c4ed4ad_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "core/themes/seven/templates/block--local-actions-block.html.twig"));

        $tags = array("if" => 9);
        $filters = array();
        $functions = array();

        try {
            $this->env->getExtension('sandbox')->checkSecurity(
                array('if'),
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

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_d763048ad6c2127da70531254822f675d53b951e3a4680fd317a78076c4ed4ad->leave($__internal_d763048ad6c2127da70531254822f675d53b951e3a4680fd317a78076c4ed4ad_prof);

    }

    // line 8
    public function block_content($context, array $blocks = array())
    {
        $__internal_f781070b2632c6a01de6d23db3eeb5496ada58509b7f4f1c997d3134fc752fad = $this->env->getExtension("native_profiler");
        $__internal_f781070b2632c6a01de6d23db3eeb5496ada58509b7f4f1c997d3134fc752fad->enter($__internal_f781070b2632c6a01de6d23db3eeb5496ada58509b7f4f1c997d3134fc752fad_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "content"));

        // line 9
        echo "  ";
        if ((isset($context["content"]) ? $context["content"] : null)) {
            // line 10
            echo "    <ul class=\"action-links\">
      ";
            // line 11
            echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["content"]) ? $context["content"] : null), "html", null, true));
            echo "
    </ul>
  ";
        }
        
        $__internal_f781070b2632c6a01de6d23db3eeb5496ada58509b7f4f1c997d3134fc752fad->leave($__internal_f781070b2632c6a01de6d23db3eeb5496ada58509b7f4f1c997d3134fc752fad_prof);

    }

    public function getTemplateName()
    {
        return "core/themes/seven/templates/block--local-actions-block.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  70 => 11,  67 => 10,  64 => 9,  58 => 8,  11 => 1,);
    }
}
/* {% extends "@block/block.html.twig" %}*/
/* {#*/
/* /***/
/*  * @file*/
/*  * Theme override for local actions (primary admin actions.)*/
/*  *//* */
/* #}*/
/* {% block content %}*/
/*   {% if content %}*/
/*     <ul class="action-links">*/
/*       {{ content }}*/
/*     </ul>*/
/*   {% endif %}*/
/* {% endblock %}*/
/* */
