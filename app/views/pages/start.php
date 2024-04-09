<p>Inicio</p>
<!--
  Ejemplo de mostrar datos de la DB con foreach
-->
<ul>
  <?php foreach ($data['items'] as $item):?>
    <li><?php echo $item->titulo;?></li>
  <?php endforeach;?>
</ul>