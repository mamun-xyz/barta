@extends('index')
@section('content')
<main
      class="container max-w-2xl mx-auto space-y-8 mt-8 px-2 md:px-0 min-h-screen">
      <!-- Newsfeed -->
      <section
        id="newsfeed"
        class="space-y-6">
        <!-- Barta Card -->
        <article
          class="bg-white border-2 border-black rounded-lg shadow mx-auto max-w-none px-4 py-5 sm:px-6">
          <!-- Barta Card Top -->
          <!-- Barta Create Comment Form -->
          <form
            action="{{ url('/store-update-comment/'.$comment_data->id) }}"
            method="POST">
            @csrf
            <!-- Create Comment Card Top -->
            <div>
              <div class="flex items-start /space-x-3/">
                <!-- User Avatar -->
                <!-- <div class="flex-shrink-0">-->
                <!--              <img-->
                <!--                class="h-10 w-10 rounded-full object-cover"-->
                <!--                src="https://avatars.githubusercontent.com/u/831997"-->
                <!--                alt="Ahmed Shamim" />-->
                <!--            </div> -->
                <!-- /User Avatar -->

                <!-- Auto Resizing Comment Box -->
                <div class="text-gray-700 font-normal w-full">
                  <textarea
                    x-data="{
                          resize () {
                              $el.style.height = '0px';
                              $el.style.height = $el.scrollHeight + 'px'
                          }
                      }"
                    x-init="resize()"
                    @input="resize()"
                    type="text"
                    name="comment"
                    placeholder="Write a comment..."
                    class="flex w-full h-auto min-h-[40px] px-3 py-2 text-sm bg-gray-100 focus:bg-white border border-sm rounded-lg border-neutral-300 ring-offset-background placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-1 focus:ring-offset-0 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50 text-gray-900">{{($comment_data->description)}}</textarea>
                </div>
              </div>
            </div>
             
            
            <!-- Create Comment Card Bottom -->
            <div>                
              <!-- Card Bottom Action Buttons -->
              <div class="flex items-center justify-end">
                 <!-- Cancel Button -->
                 <button class="mt-2 -m-2 mr-4 text-xs items-center rounded-full px-4 py-2 font-semibold bg-gray-800 hover:bg-black text-white">
                        <a href="{{ url()->previous() }}"> 
                            Cancel
                        </a>
                    </button>
                    <!-- /Cancel Button -->
                <button
                  type="submit"
                  class="mt-2 flex gap-2 text-xs items-center rounded-full px-4 py-2 font-semibold bg-gray-800 hover:bg-black text-white">
                  Comment
                </button>
              </div>
              <!-- /Card Bottom Action Buttons -->
            </div>
            <!-- /Create Comment Card Bottom -->
          </form>
          <!-- /Barta Create Comment Form -->
          <!-- /Barta Card Bottom -->
        </article>
        <!-- /Barta Card -->
      </section>
      <!-- /Newsfeed -->
    </main>
@endsection