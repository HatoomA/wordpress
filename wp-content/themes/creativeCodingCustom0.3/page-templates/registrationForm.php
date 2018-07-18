<?php
/*
 Template Name: registration form
 *
 * This is your custom page template. You can create as many of these as you need.
 * Simply name is "page-whatever.php" and in add the "Template Name" title at the
 * top, the same way it is here.
 *
 * When you create your page, you can just select the template and viola, you have
 * a custom page template to call your very own. Your mother would be so proud.
 *
 * For more info: http://codex.wordpress.org/Page_Templates
*/
?>

<?php get_header(); ?>

<div id="content" class="registerForm">
  <div id="inner-content" class="wrap cf">
      <main id="main" class="m-all t-3of3 d-7of7 cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

        <div class="registerFormWrapper">
          <?php 

            $form_hash = 0;
            if( isset($_GET['hash']) && is_string( $_GET['hash'] ) && strlen( $_GET['hash'] ) > 3 ){
              $form_hash = $_GET['hash'];
            } else{
              $region = getRegion();//DEFINED IN FUNCTIONS.PHP
              $classType = (isset($_GET['classType']) ? $_GET['classType'] : 'asp');
              $api_key    = 'YW7J-8Q1R-LVEN-ENL0';
              $subdomain  = 'cc4kforms.wufoo.com';
              if( $classType == 'asp'){
                $form_hash  = get_field($region.'_asp_form_hash');
              }
              elseif( $classType == 'sc' ){
                $form_hash  = get_field($region.'_sc_form_hash');
              }
              elseif( $classType == 'hc' ){
                $form_hash  = get_field($region.'_hc_form_hash');
              }
              else{
                echo '<h2>Could not find your form!</h2>';
              }
            }
            if( $form_hash !== 0 ){

              echo '
              <div id="wufoo-'.$form_hash.'">
                Fill out my <a href="https://cc4kforms.wufoo.com/forms/'.$form_hash.'">online form</a>.
              </div>
              <script type="text/javascript">
                var '.$form_hash.';
                (function(d, t) {
                  var s = d.createElement(t), options = {
                  \'userName\':\'cc4kforms\',
                  \'formHash\':\''.$form_hash.'\',
                  \'autoResize\':true,
                  \'height\':\'5362\',
                  \'async\':true,
                  \'host\':\'wufoo.com\',
                  \'header\':\'show\',
                  \'ssl\':true};
                  s.src = (\'https:\' == d.location.protocol ? \'https://\' : \'http://\') + \'www.wufoo.com/scripts/embed/form.js\';
                  s.onload = s.onreadystatechange = function() {
                  var rs = this.readyState; if (rs) if (rs != \'complete\') if (rs != \'loaded\') return;
                  try { '.$form_hash.' = new WufooForm();'.$form_hash.'.initialize(options);'.$form_hash.'.display(); } catch (e) {}};
                  var scr = d.getElementsByTagName(t)[0], par = scr.parentNode; par.insertBefore(s, scr);
                })(document, \'script\');
              </script>';

            }
          ?>
        </div>

      </main>
  </div>
</div>


<?php get_footer(); ?>

<!-- Unsure on best practice for including this JS for this page only. Including it here for now 
<script>
  addEvent(window, 'load', initForm);

  var highlight_array = new Array();

  function initForm(){
    initializeFocus();
    var activeForm = document.getElementsByTagName('form')[0];
    addEvent(activeForm, 'submit', disableSubmitButton);
    ifInstructs();
    showRangeCounters();
  }

  function disableSubmitButton() {
    document.getElementById('saveForm').disabled = true;
  }

  // for radio and checkboxes, they have to be cleared manually, so they are added to the
  // global array highlight_array so we dont have to loop through the dom every time.
  function initializeFocus(){
    var fields = getElementsByClassName(document, "*", "field");
    
    for(i = 0; i < fields.length; i++) {
      if(fields[i].type == 'radio' || fields[i].type == 'checkbox') {
        fields[i].onclick = function() {highlight(this, 4);};
        fields[i].onfocus = function() {highlight(this, 4);};
      }
      else if(fields[i].className.match('addr') || fields[i].className.match('other')) {
        fields[i].onfocus = function(){highlight(this, 3);};
      }
      else {
        fields[i].onfocus = function(){highlight(this, 2); };
      }
    }
  }

  function highlight(el, depth){
    if(depth == 2){var fieldContainer = el.parentNode.parentNode;}
    if(depth == 3){var fieldContainer = el.parentNode.parentNode.parentNode;}
    if(depth == 4){var fieldContainer = el.parentNode.parentNode.parentNode.parentNode;}
    
    addClassName(fieldContainer, 'focused', true);
    var focusedFields = getElementsByClassName(document, "*", "focused");
    
    for(i = 0; i < focusedFields.length; i++) {
      if(focusedFields[i] != fieldContainer){
        removeClassName(focusedFields[i], 'focused');
      }
    }
  }

  function ifInstructs(){
    var container = document.getElementById('public');
    if(container){
      removeClassName(container,'noI');
      var instructs = getElementsByClassName(document,"*","instruct");
      if(instructs == ''){
        addClassName(container,'noI',true);
      }
      if(container.offsetWidth <= 450){
        addClassName(container,'altInstruct',true);
      }
    }
  }

  function showRangeCounters(){
    counters = getElementsByClassName(document, "em", "currently");
    for(i = 0; i < counters.length; i++) {
      counters[i].style.display = 'inline';
    }
  }

  function validateRange(ColumnId, RangeType) {
    if(document.getElementById('rangeUsedMsg'+ColumnId)) {
      var field = document.getElementById('Field'+ColumnId);
      var msg = document.getElementById('rangeUsedMsg'+ColumnId);

      switch(RangeType) {
        case 'character':
          msg.innerHTML = field.value.length;
          break;
          
        case 'word':
          var val = field.value;
          val = val.replace(/\n/g, " ");
          var words = val.split(" ");
          var used = 0;
          for(i =0; i < words.length; i++) {
            if(words[i].replace(/\s+$/,"") != "") used++;
          }
          msg.innerHTML = used;
          break;
          
        case 'digit':
          msg.innerHTML = field.value.length;
          break;
      }
    }
  }

  /*--------------------------------------------------------------------------*/

  //http://www.robertnyman.com/2005/11/07/the-ultimate-getelementsbyclassname/
  function getElementsByClassName(oElm, strTagName, strClassName){
    var arrElements = (strTagName == "*" && oElm.all)? oElm.all : oElm.getElementsByTagName(strTagName);
    var arrReturnElements = new Array();
    strClassName = strClassName.replace(/\-/g, "\\-");
    var oRegExp = new RegExp("(^|\\s)" + strClassName + "(\\s|$)");
    var oElement;
    for(var i=0; i<arrElements.length; i++){
      oElement = arrElements[i];    
      if(oRegExp.test(oElement.className)){
        arrReturnElements.push(oElement);
      } 
    }
    return (arrReturnElements)
  }

  //http://www.bigbold.com/snippets/posts/show/2630
  function addClassName(objElement, strClass, blnMayAlreadyExist){
     if ( objElement.className ){
        var arrList = objElement.className.split(' ');
        if ( blnMayAlreadyExist ){
           var strClassUpper = strClass.toUpperCase();
           for ( var i = 0; i < arrList.length; i++ ){
              if ( arrList[i].toUpperCase() == strClassUpper ){
                 arrList.splice(i, 1);
                 i--;
               }
             }
        }
        arrList[arrList.length] = strClass;
        objElement.className = arrList.join(' ');
     }
     else{  
        objElement.className = strClass;
        }
  }

  //http://www.bigbold.com/snippets/posts/show/2630
  function removeClassName(objElement, strClass){
     if ( objElement.className ){
        var arrList = objElement.className.split(' ');
        var strClassUpper = strClass.toUpperCase();
        for ( var i = 0; i < arrList.length; i++ ){
           if ( arrList[i].toUpperCase() == strClassUpper ){
              arrList.splice(i, 1);
              i--;
           }
        }
        objElement.className = arrList.join(' ');
     }
  }

  //http://ejohn.org/projects/flexible-javascript-events/
  function addEvent( obj, type, fn ) {
    if ( obj.attachEvent ) {
      obj["e"+type+fn] = fn;
      obj[type+fn] = function() { obj["e"+type+fn]( window.event ) };
      obj.attachEvent( "on"+type, obj[type+fn] );
    } 
    else{
      obj.addEventListener( type, fn, false );  
    }
  }
</script>
-->