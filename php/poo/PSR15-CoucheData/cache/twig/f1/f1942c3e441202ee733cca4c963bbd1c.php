<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* home/index.twig */
class __TwigTemplate_4f136d9a6dee284caac7e1e81374a602 extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "base.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $this->parent = $this->load("base.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 4
        yield "\t";
        // line 5
        yield "\t";
        $context["i"] = 12;
        // line 6
        yield "
\t<h1>
\t\t<strong>";
        // line 8
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["title"] ?? null), "html", null, true);
        yield "</strong>

\t</h1>
\t<h2>Date du jour
\t\t";
        // line 12
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(($context["date"] ?? null), "d/m/Y H:i", "Europe/Paris"), "html", null, true);
        yield "
\t\t";
        // line 13
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["i"] ?? null), "html", null, true);
        yield "</h2>
\t";
        // line 14
        yield Twig\Extension\CoreExtension::include($this->env, $context, "home/test.twig");
        yield "

\t<h4>";
        // line 16
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["i"] ?? null), "html", null, true);
        yield "</h4>

";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "home/index.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  87 => 16,  82 => 14,  78 => 13,  74 => 12,  67 => 8,  63 => 6,  60 => 5,  58 => 4,  51 => 3,  40 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends \"base.twig\" %}

{% block content %}
\t{# Déclaration de la variable locale i #}
\t{% set i = 12 %}

\t<h1>
\t\t<strong>{{ title }}</strong>

\t</h1>
\t<h2>Date du jour
\t\t{{ date|date('d/m/Y H:i', timezone: \"Europe/Paris\") }}
\t\t{{ i }}</h2>
\t{{ include('home/test.twig') }}

\t<h4>{{ i }}</h4>

{% endblock %}
", "home/index.twig", "C:\\Users\\YvanDOUENEL\\dev\\cours\\diginamic\\2025-D03_devWeb\\php\\poo\\PSR15-CoucheData\\src\\templates\\home\\index.twig");
    }
}
