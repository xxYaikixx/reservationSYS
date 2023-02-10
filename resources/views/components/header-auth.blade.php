<p class="text-gray-500">
  こんにちは {{ Auth::user()->family_name }} {{ Auth::user()->last_name }}さん &nbsp;&nbsp;</p>
<form method="post" action="{{ route('go.login') }}">
  @csrf
  <input type="submit" class="text-indigo-600 hover:text-indigo-900" value="ログアウト" />
</form>