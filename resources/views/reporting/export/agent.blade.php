<table>
    <thead>
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Address</th>
        <th>Email</th>
        <th>Mobile Phone</th>
        <th>Register at</th>
    </tr>
    </thead>
    <tbody>
    @foreach($agents as $agent)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $agent->name }}</td>
            <td>{{ $agent->address }}</td>
            <td>{{ $agent->user->email }}</td>
            <td>{{ $agent->telp_num }}</td>
            <td>{{ $agent->created_at->format('d M, Y') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>