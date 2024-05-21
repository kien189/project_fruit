<div style="border: 1px solid green;background: lightgreen;width: 600px;margin: auto">
    <h3>Xin chào {{ $customers->name }}</h3>
    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Itaque libero nostrum, rem quis placeat cumque
        voluptates maxime ut asperiores accusamus dolorum voluptate ea pariatur natus molestiae alias dolor ducimus?
        Accusamus.</p>
    <p>
        <a href="{{route('home.reset_password',$token)}}" style="display: inline-block;padding: 7px 25px; color: #fff;background: darkblue">Nhấn vào đây để lấy lại mật khẩu mới !</a>
    </p>

</div>
