<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <script src="/js/jquery-3.2.1.min.js" charset="utf-8"></script>
    <script src="/js/bootstrap.min.js" charset="utf-8"></script>
    <title>add_server</title>
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
    <form role="form" method="POST" action="/sniper/ss-manager/servers-manager/add-server">
      {{ csrf_field() }}
      <div class="form-group">
        <label for="server_ip">请输入服务器IP地址：</label>
        <input type="text" class="form-control" id="server_ip" name="server_ip" placeholder="请输入服务器IP地址">
      </div>
      <button type="submit" class="btn btn-default">提交</button>
    </form>

  </body>
</html>
