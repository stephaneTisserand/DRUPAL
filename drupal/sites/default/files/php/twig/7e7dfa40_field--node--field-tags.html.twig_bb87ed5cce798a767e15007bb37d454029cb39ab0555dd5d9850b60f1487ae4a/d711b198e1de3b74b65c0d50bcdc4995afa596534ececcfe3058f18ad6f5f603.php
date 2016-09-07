<?php

/* core/themes/bartik/templates/field--node--field-tags.html.twig */
class __TwigTemplate_34fb2cb3bc2e36176859ef66a0f48682a510ba8be089beeb4a3410de29103144 extends Twig_Template
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
        $__internal_26aba9d95c715aa7b5a34deefc21f9fa7440ef0ed95895b6805db4810b4829fb = $this->env->getExtension("native_profiler");
        $__internal_26aba9d95c715aa7b5a34deefc21f9fa7440ef0ed95895b6805db4810b4829fb->enter($__internal_26aba9d95c715aa7b5a34deefc21f9fa7440ef0ed95895b6805db4810b4829fb_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "core/themes/bartik/templates/field--node--field-tags.html.twig"));

        $tags = array("set" => 24, "if" => 39, "for" => 43);
        $filters = array("clean_class" => 26);
        $functions = array();

        try {
            $this->env->getExtension('sandbox')->checkSecurity(
                array('set', 'if', 'for'),
                array('clean_class'),
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

        // line 24
        $context["classes"] = array(0 => "field", 1 => ("field--name-" . \Drupal\Component\Utility\Html::getClass(        // line 26
(isset($context["field_name"]) ? $context["field_name"] : null))), 2 => ("field--type-" . \Drupal\Component\Utility\Html::getClass(        // line 27
(isset($context["field_type"]) ? $context["field_type"] : null))), 3 => ("field--label-" .         // line 28
(isset($context["label_display"]) ? $context["label_display"] : null)), 4 => "clearfix");
        // line 33
        $context["title_classes"] = array(0 => "field__label", 1 => (((        // line 35
(isset($context["label_display"]) ? $context["label_display"] : null) == "inline")) ? ("inline") : ("")));
        // line 38
        echo "<div";
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute((isset($context["attributes"]) ? $context["attributes"] : null), "addClass", array(0 => (isset($context["classes"]) ? $context["classes"] : null)), "method"), "html", null, true));
        echo ">
  ";
        // line 39
        if ( !(isset($context["label_hidden"]) ? $context["label_hidden"] : null)) {
            // line 40
            echo "    <h3";
            echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute((isset($context["title_attributes"]) ? $context["title_attributes"] : null), "addClass", array(0 => (isset($context["title_classes"]) ? $context["title_classes"] : null)), "method"), "html", null, true));
            echo ">";
            echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["label"]) ? $context["label"] : null), "html", null, true));
            echo "</h3>
  ";
        }
        // line 42
        echo "  <ul class=\"links field__items\">
    ";
        // line 43
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["items"]) ? $context["items"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 44
            echo "      <li";
            echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute($context["item"], "attributes", array()), "html", null, true));
            echo ">";
            echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute($context["item"], "content", array()), "html", null, true));
            echo "</li>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 46
        echo "  </ul>
</div>
";
        
        $__internal_26aba9d95c715aa7b5a34deefc21f9fa7440ef0ed95895b6805db4810b4829fb->leave($__internal_26aba9d95c715aa7b5a34deefc21f9fa7440ef0ed95895b6805db4810b4829fb_prof);

    }

    public function getTemplateName()
    {
        return "core/themes/bartik/templates/field--node--field-tags.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  87 => 46,  76 => 44,  72 => 43,  69 => 42,  61 => 40,  59 => 39,  54 => 38,  52 => 35,  51 => 33,  49 => 28,  48 => 27,  47 => 26,  46 => 24,);
    }
}
/* {#*/
/* /***/
/*  * @file*/
/*  * Bartik theme override for taxonomy term fields.*/
/*  **/
/*  * Available variables:*/
/*  * - attributes: HTML attributes for the containing element.*/
/*  * - label_hidden: Whether to show the field label or not.*/
/*  * - title_attributes: HTML attributes for the label.*/
/*  * - label: The label for the field.*/
/*  * - content_attributes: HTML attributes for the content.*/
/*  * - items: List of all the field items. Each item contains:*/
/*  *   - attributes: List of HTML attributes for each item.*/
/*  *   - content: The field item's content.*/
/*  * - entity_type: The entity type to which the field belongs.*/
/*  * - field_name: The name of the field.*/
/*  * - field_type: The type of the field.*/
/*  * - label_display: The display settings for the label.*/
/*  **/
/*  * @see template_preprocess_field()*/
/*  *//* */
/* #}*/
/* {%*/
/*   set classes = [*/
/*     'field',*/
/*     'field--name-' ~ field_name|clean_class,*/
/*     'field--type-' ~ field_type|clean_class,*/
/*     'field--label-' ~ label_display,*/
/*     'clearfix',*/
/*   ]*/
/* %}*/
/* {%*/
/*   set title_classes = [*/
/*     'field__label',*/
/*     label_display == 'inline' ? 'inline',*/
/*   ]*/
/* %}*/
/* <div{{ attributes.addClass(classes) }}>*/
/*   {% if not label_hidden %}*/
/*     <h3{{ title_attributes.addClass(title_classes) }}>{{ label }}</h3>*/
/*   {% endif %}*/
/*   <ul class="links field__items">*/
/*     {% for item in items %}*/
/*       <li{{ item.attributes }}>{{ item.content }}</li>*/
/*     {% endfor %}*/
/*   </ul>*/
/* </div>*/
/* */
