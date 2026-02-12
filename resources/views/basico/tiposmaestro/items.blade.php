<fieldset>
<hr/>
<legend>Items</legend>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="name">NOMBRE:</label>
            <input type="text" class="form-control" id="name_item" placeholder="Nombre" value="" required>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="numitem">NUM ITEM:</label>
            <input type="number" class="form-control" id="numitem_item" min="1" max="10" value="" required>
        </div>
    </div>
</div>

<div class="row">

    <div class="col-md-6">
        <div class="form-group">
            <label for="note">OBSERVACIÓN:</label>
            <textarea class="form-control" id="note_item" required></textarea>
        </div>
    </div>    

    <div class="col-md-6">
        <div class="form-group">
            <label for="state">ESTADO:</label>
            <select class="form-control" name="state" id="state_item" required>
                <option value="1" >ACTIVO</option>
                <option value="0" >INACTIVO</option>
            </select>
        </div>
    </div>

    <div class="col-md-2">
        <button type="button" class="btn btn-danger" onclick="addItem()" >
            Agregar <i class="fa fa-paper-plane"></i>
        </button>
    </div>
</div>
<div class="row">
    <p></p>
</div>

<div class="row">

    <table class="table" id="table_items">
        <thead>
            <tr>
            <th scope="col">Item</th>
            <th scope="col">#</th>
            <th scope="col">Observacion</th>
            <th scope="col">Estado</th>
            <th></th>
            </tr>
        </thead>
        <tbody>
             
        @if(isset($tipomaestro) && $tipomaestro->tiposmaestroitem != null)
            @foreach($tipomaestro->tiposmaestroitem as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->nombre}}</td>
                    <td>{{$item->numitem}}</td>
                    <td>{{$item->observacion}}</td>
                    <td>{{$item->estado}}</td>
                    <td>
                        <button type="button" class="btn btn-danger"
                            onclick="removeItem('item_{{$loop->iteration}}')">
                            <i class="fa fa-window-close"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>

</div>
</fieldset>

<script>

    let lineNo = 0;
    function addItem() {
        console.log("addItem");

        var name_item = $("#name_item").val();
        var numitem_item = $("#numitem_item").val();
        var note_item = $("#note_item").val();
        var state_item_text = ( $("#state_item").val() == 1 ) ? "Activo" : "Inactivo" ;
        var state_item = $("#state_item").val();

        if (name_item != "" && numitem_item != "" && note_item != "" && state_item != "") {
            lineNo++;
            var markup = "<tr id='item_" + lineNo + "'><td>" + name_item + " <input type='hidden' name='items["+lineNo+"][name]' value='" + name_item + "'></td><td>" + numitem_item + " <input type='hidden' name='items["+lineNo+"][num]' value='" + numitem_item + "'></td><td>"+note_item+" <input type='hidden' name='items["+lineNo+"][note]' value='" + note_item + "'></td><td>"+state_item_text+" <input type='hidden' name='items["+lineNo+"][state]' value='" + state_item + "'></td><td> <button type=\"button\" class=\"btn btn-danger\" onclick=\"removeItem('item_" + lineNo + "')\"><i class=\"fa fa-window-close\"></i> </button></td></tr>";
            var tableBody = $("#table_items tbody");
            tableBody.append(markup);
        }
    }
    

    function removeItem(elemt) {
        console.log("removeItem");
        lineNo--;
        $('#' + elemt).fadeOut('slow', function () {
            $('#' + elemt).remove();
        });
    }


</script>