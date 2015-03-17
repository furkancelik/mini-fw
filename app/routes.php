<?php
use App\Core\Route as Route;

Route::get('/aa',function(){
    $a = <<<ASD
<form method="POST" action="">
<input type="text" name="name" />
<input type="submit" value="Gönder" />
</form>
ASD;
//echo $a;
    return "Merhaba aa!";

});
/*

$route->get('/hello',array('n'=>'index','c'=>'IndexC@index'));

$route->post('/',function(){
    //return false;//Input::get('name');
    //return "Merhaba POST!";

});


for($i=0;$i<1000;$i++)
{
    $route->get('/sd/'.$i,function() use ($i){
        return "Sayfa No:".$i;
    });
}
*/

