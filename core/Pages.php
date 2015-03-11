<?php

$route->get('/',function(){
    return "Merhaba GET!";

});

$route->post('/',function(){
    return "Merhaba POST!";

});

for($i=0;$i<1000;$i++)
{
    $route->get('/sd/'.$i,function() use ($i){
        return "Sayfa No:".$i;
    });
}
