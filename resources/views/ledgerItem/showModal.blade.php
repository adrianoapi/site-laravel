<table border="0">
  <tr>
    <td rowspan="3"><img src="data:{{$collItem->images[0]->type}};base64, {{$collItem->images[0]->image}}" width="300" alt="" /></td>
    <td>&nbsp;</td>
    <td>Coleção:<br> {{$collItem->collection->title}}</td>
  </tr>
  <tr>
    <td></td>
    <td>Item:<br> {{$collItem->title}}</td>
  </tr>
  <tr>
    <td></td>
    <td>Lançamento:<br> {{$collItem->release}}</td>
  </tr>
</table>
<hr>
Descrição: {!! html_entity_decode($collItem->description) !!}
