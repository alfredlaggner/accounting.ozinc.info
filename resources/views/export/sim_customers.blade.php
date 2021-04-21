<table>
    <thead>
    <tr>
        <th>Account</th>
        <th>Client Name</th>
        <th>Display Name</th>
        <th>Business Name</th>
        <th>Street</th>
        <th>City</th>
        <th>Zip</th>
        <th>Email</th>
        <th>License</th>
        <th>Phone</th>
        <th>Mobile</th>
        <th>Total Due</th>
        <th>Sale Order Count</th>
        <th>Total Invoiced</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($all_results as $result)
        <tr>
            <td>{{$result['Account']}}</td>
            <td>{{$result['ClientName']}}</td>
            <td>{{$result['DisplayName']}}</td>
            <td>{{$result['BusinessName']}}</td>
            <td>{{$result['Street']}}</td>
            <td>{{$result['City']}}</td>
            <td>{{$result['Zip']}}</td>
            <td>{{$result['Email']}}</td>
            <td>{{$result['License']}}</td>
            <td>{{$result['Phone']}}</td>
            <td> </td>
            <td>{{$result['TotalDue']}}</td>
            <td>0</td>
            <td>0.00</td>
        </tr>

    @endforeach
    </tbody>
</table>
