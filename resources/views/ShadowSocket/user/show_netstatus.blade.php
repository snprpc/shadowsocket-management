<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <script src="/js/jquery-3.2.1.min.js" charset="utf-8"></script>
    <script src="/js/bootstrap.min.js" charset="utf-8"></script>
    <title>show server</title>
  </head>
  <body>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="panel panel-info">
      <div class="panel-heading">
        <h3 class="panel-title">服务器表现</h3>
      </div>
      <table class="table table-hover">
        <thead>
          <tr>
            <th>IP_Address</th>
            <th>IP_Area</th>
            <th>Packages</th>
            <th>Min_Delay</th>
            <th>Avg_Delay</th>
            <th>Max_Delay</th>
            <th>Operation</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($servers as $server)
          <tr>
            <form role="form" action="/sniper/ss-manager/allocation-manager/allocation-port" method="POST">
              {{ csrf_field() }}
              <td>
                <input type="text" name="server_ip" id="server_ip" value="{{ $server['ip'] }}" readonly="true">
              </td>
              <td>{{ $server['area'] }}</td>
              <td>{{ $server['packages'] }}</td>
              <td>{{ $server['max_network_delay'] }}</td>
              <td>{{ $server['avg_network_delay'] }}</td>
              <td>{{ $server['min_network_delay'] }}</td>
              <td><button type="submit" class="btn btn-info btn-xs" >下一步</button></td>
            </form>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>




  </body>
  <style media="screen">
    #server_ip{
      border: 0;
      background-color: white;
    }
  </style>
</html>
