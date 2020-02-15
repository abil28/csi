<!-- Name Text Field Input -->
<div class="card-body">
                    <table width="100%">
                        <tr>
                            <th width="20%">NIM</th>
                            <td>:</td>
                            <td>{{ Auth::user()->student->nim }}</td>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <td>:</td>
                            <td>{{ ucwords(strtolower(Auth::user()->student->name)) }}</td>
                        </tr>
                    </table>
</div>
