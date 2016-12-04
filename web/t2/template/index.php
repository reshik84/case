<?php
/*
 * Layout configurator
 * You can rewrite settings from Site Engine
*/

/* sidebars size in 12-columns-gride layout */
$col1size=2;
$col3size=2;

/* sidebars positions: 0 - left or 1 - right */
$col1pos=0;
$col3pos=1;

$col1=0;// count modules in sidebar1 position
$col3=0;// count modules in sidebar2 position
//if $col1==0 || $col2==0 sidebars has no display accordingly

$col1class='';
$col3class='';
if($col1 && $col3 && $col1pos==0 && $col3pos==0){
 //обе слева
 $col1class=' both-left';
 $col3class=' both-left';
}elseif($col1 && $col3 && $col1pos==1 && $col3pos==1){
 //обе справа
 $col1class=' both-right';
 $col3class=' both-right';
}elseif($col1 && $col1pos==0 && ($col3pos==1 || !$col3)){
 //col1 одна слева
 $col1class=' single-left';
 $col3class=($col3pos)?' single-right':' single-left';
}elseif($col3 && $col3pos==0 && ($col1pos==1 || !$col1)){
 //col3 одна слева
 $col1class=($col1pos)?' single-right':' single-left';
 $col3class=' single-left';
}elseif($col3 && $col3pos==1 && ($col1pos==0 || !$col1)){
 //col3 одна справа
 $col3class=' single-right';
}elseif($col1 && $col1pos==1 && ($col3pos==0 || !$col3)){
 //col1 одна справа
 $col1class=' single-right';
}

$col1class=' class="span'.$col1size.$col1class.'"';
$col3class=' class="span'.$col3size.$col3class.'"';

// /css/print.css

?><!doctype html>
<html lang="ru">
<head>
<meta charset="utf-8">
<title>Bla-Bla</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=3.0, user-scalable=yes" />
<link href="css/template.css" rel="stylesheet" type="text/css">
</head>

<body>
<div id="flare"><div id="wrapper">
 <!-- <div id="topline"></div> -->
 <header>
  <div id="smart-icons" class="smart-icons"></div>
  <div id="search" class="search"></div>
<nav class="mainnavigation top">
<ul>
<li><a href="#">Главная</a></li>
<li><a href="#">Мы вконтакте</a></li>
<li><a href="#">FAQ</a></li>
<li><a href="#">О нас</a>
  <ul>
  <li><a href="#">Главная</a></li>
  <li><a href="#">Мы вконтакте</a></li>
  <li><a href="#">FAQ</a>
  <ul>
  <li><a href="#">Главная</a></li>
  <li><a href="#">Мы вконтакте</a></li>
  <li><a href="#">FAQ</a></li>
  <li><a href="#">О нас</a></li>
  <li><a href="#">Вход</a></li>
  <li><a href="#">Регистрация</a></li>                                             
  </ul>
  </li>
  <li><a href="#">О нас</a></li>
  <li><a href="#">Вход</a></li>
  <li><a href="#">Регистрация</a></li>                                             
  </ul>
</li>
<li><a href="#">Вход</a></li>
<li><a href="#">Регистрация</a></li>                                             
</ul>
</nav>
</header>
<div id="colswrp">
<?php
 if(!$col1pos && $col1){
  echo '<div id="column1"'.$col1class.'><div>';
  // include modules in this position
  echo '</div></div>';
 }
 if(!$col3pos && $col3){
  echo '<div id="column3"'.$col3class.'><div>';
  // include modules in this position
  echo '</div></div>';
 }
?>
<div id="column2"><main>
<!-- DELETE FROM HERE -->
<h1>The main content</h1>
<p>This is version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.</p>
<p>Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non  mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris in erat justo. Nullam ac urna eu felis dapibus condimentum sit amet a augue. Sed non neque elit. Sed ut imperdiet nisi. Proin condimentum fermentum nunc. Etiam pharetra, erat sed fermentum feugiat, velit mauris egestas quam, ut aliquam massa nisl quis neque. Suspendisse in orci enim. This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non  mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p>
<p>Mauris in erat justo. Nullam ac urna eu felis dapibus condimentum sit amet a augue. Sed non neque elit. Sed ut imperdiet nisi. Proin condimentum fermentum nunc. Etiam pharetra, erat sed fermentum feugiat, velit mauris egestas quam, ut aliquam massa nisl quis neque. Suspendisse in orci enim.</p>
<p>This is version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.</p>

<form method="post" name="yo-yo">
<fieldset>
<legend>Регистрация</legend>
<input type="text" name="name" id="name" value="" placeholder="Логин" /><br>
<input type="password" name="password" id="password" value="" placeholder="Пароль" /><br>
<textarea name="textarea" id="textarea" placeholder="Textarea"></textarea><br>
<label><input type="radio" name="radio" id="radio1" value="1" checked /> 1 </label><br>
<label><input type="radio" name="radio" id="radio2" value="2" /> 2 </label><br>
<label><input type="radio" name="radio" id="radio3" value="3" /> 3 </label><br>
<label><input type="radio" name="radio" id="radio4" value="4" /> 4 </label><br>
<label><input type="checkbox" name="checkbox" id="checkbox" value="1" /> Присылать мне <a href="#">спам</a></label><br><br>
<button>button</button>
<input type="button" value="ibutton" />
<input type="submit" value="submit" />
<input type="reset" value="Ёпс-с-с!" />
<input type="file" value="Засосать" />
</fieldset>
</form>

<h2>Кейсы</h2>
<div class="cases">
<div>
 <p>Содержит от 10 до 25р. <span class="case-box"></span></p>
 <p>25р.</p>
 <p><a class="button" href="#">Открыть</a></p>
</div>
<div>
 <p>Содержит от 25000 до 99999р. <span class="case-box-winner"></span></p>
 <p>32231р.</p>
 <p><a class="button" href="#">Открыть</a></p>
</div>
<div>
 <p>Содержит от 2500 до 24999р. <span class="case-box-half-winner"></span></p>
 <p>18250р.</p>
 <p><a class="button" href="#">Открыть</a></p>
</div>

<div>
 <p>Содержит от 25 до 249р. <span class="case-box"></span></p>
 <p>50р.</p>
 <p><a class="button" href="#">Открыть</a></p>
</div>
<div>
 <p>Содержит от 250 до 1000р. <span class="case-box-left"></span></p>
 <p>555р.</p>
 <p><a class="button" href="#">Открыть</a></p>
</div>
<div>
 <p>Содержит от 1001 до 2499р. <span class="case-box-right"></span></p>
 <p>1820р.</p>
 <p><a class="button" href="#">Открыть</a></p>
</div>
<div>
 <p>Содержит от 0 до 10р. <span class="case-box-gold"></span></p>
 <p>0.12р.</p>
 <p><a class="button" href="#">Открыть</a></p>
</div>
<div>
 <p>Содержит < 0 <span class="case-box-prize"></span></p>
 <p>-10820р.</p>
 <p><a class="button" href="#">Открыть</a></p>
</div>

</div>

<h2>Последние открытия кейсов</h2>
<div class="cases got">
<div>
 <p>Алексей Шевченко</p>
 <p>получил</p>
 <p>25р.</p>
</div>
<div>
 <p>Алексей Шевченко</p>
 <p>получил</p>
 <p>25р.</p>
</div>
<div>
 <p>Алексей Шевченко</p>
 <p>получил</p>
 <p>25р.</p>
</div>
</div>
<h2>Самые везучие</h2>
<div class="cases luckiest">
<div>
 <p>Алексей Шевченко</p>
 <p>9215р.</p>
</div>
<div>
 <p>Алексей Шевченко</p>
 <p>9215р.</p>
</div>
<div>
 <p>Алексей Шевченко</p>
 <p>9215р.</p>
</div>
</div>
<h2>Последние выводы</h2>
<div class="cases latest">
<div>
 <p>Алексей Шевченко</p>
 <p>вывел</p>
 <p>25р.</p>
</div>
<div>
 <p>Алексей Шевченко</p>
 <p>вывел</p>
 <p>25р.</p>
</div>
<div>
 <p>Алексей Шевченко</p>
 <p>вывел</p>
 <p>25р.</p>
</div>
</div>
<!-- DELETE TO HERE -->
</main></div>
<?php
 if($col1pos && $col1){
  echo '<div id="column1"'.$col1class.'><div>';
  // include modules in this position
  echo '</div></div>';
 }

 if($col3pos && $col3){
  echo '<div id="column3"'.$col3class.'><div>';
  // include modules in this position
  echo '</div></div>';
 }

// /colswrp
?>
</div>
<nav class="mainnavigation bottom">
<ul>
<li><a href="#">Главная</a></li>
<li><a href="#">Мы вконтакте</a></li>
<li><a href="#">FAQ</a></li>
<li><a href="#">О нас</a>
  <ul>
  <li><a href="#">Главная</a></li>
  <li><a href="#">Мы вконтакте</a></li>
  <li><a href="#">FAQ</a>
  <ul>
  <li><a href="#">Главная</a></li>
  <li><a href="#">Мы вконтакте</a></li>
  <li><a href="#">FAQ</a></li>
  <li><a href="#">О нас</a></li>
  <li><a href="#">Вход</a></li>
  <li><a href="#">Регистрация</a></li>                                             
  </ul>
  </li>
  <li><a href="#">О нас</a></li>
  <li><a href="#">Вход</a></li>
  <li><a href="#">Регистрация</a></li>                                             
  </ul>
</li>
<li><a href="#">Вход</a></li>
<li><a href="#">Регистрация</a></li>                                             
</ul>
</nav>
<aside class="ecards">
<img src="!content/maestro.png" alt="maestro" />
<img src="!content/master-card.png" alt="master-card" />
<img src="!content/pay-pal.png" alt="pay-pal" />
<img src="!content/visa.png" alt="visa" />
<img src="!content/visa-electron.png" alt="visa-electron" />
</aside>
<footer><div class="copyright">&copy; <a href="#">SuperMegaGlobalDesign</a> | Все права защищены.</div> This is a main footer</footer>
</div></div>
</body>
</html>