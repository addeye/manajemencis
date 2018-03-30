<table id="example" class="table table-bordered table-striped">
    <thead>
    <tr>
        <th class="col-xs-1">No</th>
        <th>Program</th>
        <th>Tujuan</th>
    </tr>
    </thead>
    <tbody>
    <?php $no = 1;?>
    @foreach($proker as $row)
        <tr>
            <td>{{$no++}}</td>
            <td>{{$row->program}}</td>
            <td>{{$row->tujuan}}</td>
        </tr>
    @endforeach
    </tbody>
</table>