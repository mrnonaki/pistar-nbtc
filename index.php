<script type="text/javascript" src="/jquery.min.js"></script>
<script type="text/javascript">$.ajaxSetup({ cache: false });</script>

<script type="text/javascript">
function reloadLastHerd(){
  $("#lastHerd").load("lh.php",function(){ setTimeout(reloadLastHerd,1000) });
}
setTimeout(reloadLastHerd,1000);
$(window).trigger('resize');
</script>

<div id="lastHerd">
<?php include 'lh.php';?>
</div>
