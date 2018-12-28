<?php

/* Index/index.phtml */
class __TwigTemplate_b58e6a88107ecab0cb98524528cf3e26d08fbe1999ac32e5fc04b5a86cc9afc4 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">
<title>陪你ら不孤单゛</title>
<meta charset=\"utf-8\">
<meta name=\"viewport\" content=\"initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no\">
<link rel=\"stylesheet\" href=\"resource/web/css/app.css\">
<script src=\"resource/web/js/jquery.min.js\" type=\"text/javascript\"></script>

<link rel=\"stylesheet\" href=\"resource/web/css/viewer.min.css\">
<script src=\"resource/web/js/viewer.min.js\"></script>

</head>
<body>
\t<!-- 背景图 -->
\t<div style=\"margin:0 auto;display:none;\">
\t\t<img class=\"data-avt\" src=\"resource/web/images/0.png\">
\t</div>
\t<!-- 背景图2 -->
\t<header>
\t\t<img id=\"bg\" src=\"resource/web/images/timg.jpg\">
\t\t<p id=\"user-name\" class=\"data-name\">陪你ら不孤单゛</p>
\t\t<img id=\"avt\" class=\"data-avt\" src=\"resource/web/images/0.png\">
\t</header>
\t<!-- 主页 -->
\t<div id=\"main\">
\t\t<div id=\"list\">
\t\t\t<ul id=\"jq22\">
\t\t\t\t";
        // line 30
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["data"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["val"]) {
            // line 31
            echo "
\t\t\t\t\t<li>
\t\t\t\t\t\t<div class=\"po-avt-wrap\">
\t\t\t\t\t\t\t<img class=\"po-avt data-avt\" src=\"resource/web/images/0.png\">
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"po-cmt\">
\t\t\t\t\t\t\t<div class=\"po-hd\">
\t\t\t\t\t\t\t\t<p class=\"po-name\"><span class=\"data-name\">陪你ら不孤单゛</span></p>
\t\t\t\t\t\t\t\t<div class=\"post\">
\t\t\t\t\t\t\t\t\t<p>";
            // line 40
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["val"], "content", array()), "html", null, true);
            echo "</p>
\t\t\t\t\t\t\t\t\t<p>
\t\t\t\t\t\t\t\t\t\t";
            // line 42
            if (twig_get_attribute($this->env, $this->source, $context["val"], "ArticleImgInfo", array())) {
                // line 43
                echo "\t\t\t\t\t\t\t\t\t\t\t";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["val"], "ArticleImgInfo", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["v"]) {
                    // line 44
                    echo "\t\t\t\t\t\t\t\t\t\t\t\t<img class=\"list-img data-avt\" src=\"";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["v"], "img_url", array()), "html", null, true);
                    echo "\" style=\"height: 80px;\">
\t\t\t\t\t\t\t\t\t\t\t\t<!-- resource/web/images/0.png -->
\t\t\t\t\t\t\t\t\t\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['v'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 47
                echo "\t\t\t\t\t\t\t\t\t\t";
            }
            // line 48
            echo "\t\t\t\t\t\t\t\t\t</p>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<p class=\"time\">";
            // line 50
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["val"], "create_time", array()), "html", null, true);
            echo "</p><!-- <img class=\"c-icon\" src=\"images/c.png\"> -->
\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t<!-- <div class=\"r\"></div> -->
\t\t\t\t\t\t\t<!-- <div class=\"cmt-wrap\">
\t\t\t\t\t\t\t\t<div class=\"like\"><img src=\"images/l.png\">苍井空，陈冠希，杨幂，王思聪，陈赫，刘德华，马云...</div>
\t\t\t\t\t\t\t\t<div class=\"cmt-list\">
\t\t\t\t\t\t\t\t\t<p><span>wu世勋-EXO：</span>나는 서명～</p>
\t\t\t\t\t\t\t\t\t<p><span>鹿晗：</span>我们在国内冻成狗，我也想跟哥您去热热～</p>
\t\t\t\t\t\t\t\t\t<p><span>权志龙：</span>나는 서명～</p>
\t\t\t\t\t\t\t\t\t<p><span>王思聪：</span>去哪玩啊？那么爽</p>
\t\t\t\t\t\t\t\t\t<p>
\t\t\t\t\t\t\t\t\t\t<span class=\"data-name\">某某科技~贾素杰</span>
\t\t\t\t\t\t\t\t\t\t回复
\t\t\t\t\t\t\t\t\t\t<span>王思聪</span>
\t\t\t\t\t\t\t\t\t\t<span>：</span>
\t\t\t\t\t\t\t\t\t\t澳洲大堡礁，这边刚好是夏季，挺适合避寒的。
\t\t\t\t\t\t\t\t\t</p>
\t\t\t\t\t\t\t\t\t<p><span>杨幂：</span>😘私人飞机出行，求带上我～</p>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div> -->
\t\t\t\t\t\t</div>
\t\t\t\t\t</li>
\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['val'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 74
        echo "\t\t\t</ul>
\t\t</div>

\t</div>



<script type=\"text/javascript\">

\tfunction gotoplay(scene) {
\t\tvar gourl = \"/act/pengYouQuan/my.php?sv=\" + scene;
\t\tlocation.href = gourl;
\t}
\tfunction safetostring(str) {
\t\treturn String(str).replace(/&amp;/g, '&').replace(/&lt;/g, '<').replace(/&gt;/g, '>').replace(/&quot;/g, '\"').replace(/&#39;/g, \"'\");
\t}

\t//\$(\"#list\").html(\$(\"#scene\").html());

\tsetTimeout(function () {
\t\t// \$(\".data-name\").text(safetostring(nickname));
\t\t//\$(\".data-avt\").attr(\"src\", headimgurl);
\t\tvar cw = \$('.list-img').width();
\t\t\$('.list-img').css({'height': cw + 'px'});
\t}, 0);

\t\$(window).resize(function () {
\t\tvar cw = \$('.list-img').width();
\t\t\$('.list-img').css({'height': cw + 'px'});
\t});


\t\$(document.body).show();


\tfunction hideActionSheet(weuiActionsheet, mask) {
\t\tweuiActionsheet.removeClass('weui_actionsheet_toggle');
\t\tmask.removeClass('weui_fade_toggle');
\t\tweuiActionsheet.on('transitionend', function () {
\t\t\tmask.hide();
\t\t}).on('webkitTransitionEnd', function () {
\t\t\tmask.hide();
\t\t})
\t}
\tfunction showActionSheet() {
\t\tvar mask = \$('#mask');
\t\tvar weuiActionsheet = \$('#weui_actionsheet');
\t\tweuiActionsheet.addClass('weui_actionsheet_toggle');
\t\tmask.show().addClass('weui_fade_toggle').click(function () {
\t\t\thideActionSheet(weuiActionsheet, mask);
\t\t});
\t\t\$('#actionsheet_cancel').click(function () {
\t\t\thideActionSheet(weuiActionsheet, mask);
\t\t});
\t\tweuiActionsheet.unbind('transitionend').unbind('webkitTransitionEnd');
\t}
\t// \$('#list').not(\".noplayimg\").on('click', function () {
\t// \tshowActionSheet();
\t// });
\t// \$('img').not(\".noplayimg\").on('click', function (e) {
\t// \tshowActionSheet();
\t// });

\t\$('.play_pyq').on('click', function () {
\t\tvar scene = \$(this).data(\"scene\");
\t\tgotoplay(scene);
\t});

\tvar viewer = new Viewer(document.getElementById('jq22'), {
\t\ttoolbar: false,
\t\turl: 'data-original'

\t});
</script>

</body>
</html>
";
    }

    public function getTemplateName()
    {
        return "Index/index.phtml";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  128 => 74,  98 => 50,  94 => 48,  91 => 47,  81 => 44,  76 => 43,  74 => 42,  69 => 40,  58 => 31,  54 => 30,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "Index/index.phtml", "/Applications/XAMPP/xamppfiles/htdocs/friends/apps/Web/views/Index/index.phtml");
    }
}
