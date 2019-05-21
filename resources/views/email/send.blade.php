<p>Your Code is {{$user->code}}</p>
<p>To Reset Password <a href="{{route('sendCodeDone',
['email'=>$user->email,'code'=>$user->code])}}">
Click here
</a></p>

