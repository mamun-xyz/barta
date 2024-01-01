@extends('index')
@section('content')
  <body>
    <div class="bg-gradient-to-r from-purple-300 to-blue-200">
      <div class="w-9/12 m-auto py-16 min-h-screen flex items-center justify-center">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg pb-8">
          <div class="border-t border-gray-200 text-center pt-8">
            <h1 class="text-7xl font-bold text-purple-400">Sorry! </h1>
            <h1 class="text-6xl font-medium py-8">No Result Found.</h1>
            <p class="text-2xl pb-8 px-12 font-medium">Oops! The user you are looking for does not exist. He might have left or changed his user information.</p>
            <button class="bg-gradient-to-r from-purple-400 to-blue-500 hover:from-pink-500 hover:to-orange-500 text-white font-semibold px-6 py-3 rounded-md mr-6"><a href="{{ url('/') }}">HOME</a></button>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
@endsection