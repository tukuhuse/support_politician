<!DOCTYPE html>
<html>
    <body>
        @foreach($members as $key=>$index)
            <tr>
                <td>{{ $key }} . ':' . {{ $index }}</td>
            </tr>
        @endforeach
    </body>
</html>