<h3>Xin chào : {{ $account->name }}</h3>

<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore facilis dolore totam voluptas vitae labore nostrum
    velit excepturi ipsam architecto! Numquam, iusto blanditiis. Similique, consectetur! Tenetur rem excepturi iure
    aliquam!</p>

<p>
    <a href="{{route('account.verify',$account->email)}}">CLick here to verify your account</a>
</p>
