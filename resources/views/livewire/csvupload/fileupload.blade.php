<div class="mt-10">
   <div class="px-6 lg:px-8 ">
  <div class="sm:flex sm:items-center">
    <div class="sm:flex-auto">
      <h1 class="text-xl font-semibold text-gray-900">CSV</h1>
    
    </div>
    <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none mt-10">
      <button type="button" wire:click="uploadbutton()" class="mt-10 block rounded-md bg-indigo-600 py-1.5 px-3 text-center text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Upload</button>
    </div>
  </div>
     <div wire:ignore>
        <x-auth-session-status-custom class="mb-4 mt-4" :status="session('status')" />
        </div> 


  <div class="mt-8 flow-root">
      <div class="flex">
      <input type="text"  wire:model.defer="query" class="px- py-2" placeholder="Search..."  wire:keydown.enter="searchitem"> 
      <button  wire:click="searchitem()" class="flex items-center justify-center px-4 border-l">
        <svg class="h-4 w-4 text-grey-dark" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M16.32 14.9l5.39 5.4a1 1 0 0 1-1.42 1.4l-5.38-5.38a8 8 0 1 1 1.41-1.41zM10 16a6 6 0 1 0 0-12 6 6 0 0 0 0 12z"/></svg>
      </button>

    </div>
    <div class="-my-2 -mx-6 overflow-x-auto lg:-mx-8">
      <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
        <table class="min-w-full divide-y divide-gray-300">
          <thead>
            <tr>
                 <th scope="col" class="py-3.5 pl-6 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">id</th>
              <th scope="col" class="py-3.5 pl-6 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Title</th>
              <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">First Name</th>
              <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">Last Name</th>
              <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">Mobile Number</th>
              <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">Company Name</th>
              <th scope="col" class="relative py-3.5 pl-3 pr-6 sm:pr-0">
                <span class="sr-only">Edit</span>
              </th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200">
              @foreach($listcsv as $list)
            <tr>
               <td class="whitespace-nowrap py-4 pl-6 pr-3 text-sm font-medium text-gray-900 sm:pl-0">{{$list->id}}</td>
              <td class="whitespace-nowrap py-4 pl-6 pr-3 text-sm font-medium text-gray-900 sm:pl-0">{{$list->title}}</td>
              <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">{{$list->firstname}}</td>
              <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">{{$list->lastname}}</td>
              <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">{{$list->mobilenumber}}</td>
                <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">{{$list->companyname}}</td>
              <td class="relative whitespace-nowrap py-4 pl-3 pr-6 text-right text-sm font-medium sm:pr-0">
                <a href="#" wire:click="editdata({{$list->id}})" class="text-indigo-600 hover:text-indigo-900">Edit<span class="sr-only">, Lindsay Walton</span></a>
                  <a href="#" wire:click="deleteData({{$list->id}})" class="text-red-600 hover:text-red-900">delete<span class="sr-only">, Lindsay Walton</span></a>
              </td>
            </tr>
           @endforeach
            <!-- More people... -->
          </tbody>
        </table>
          {{ $listcsv->links() }}
      </div>
    </div>
  </div>
</div>
  @if($isOpen && $action=='update')
         <div class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true"  @click.away="closeModal()">
                  <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                  
                  <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                  <!-- This element is to trick the browser into centering the modal contents. -->
                  <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>


                  <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" @click.away="open=false">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                      <div class="">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                          <h2 class="pb-5 text-xl leading-6 font-medium text-gray-900 lg:border-b lg:border-gray-200" id="modal-title">
                            Upload file
                          </h2>

                     @if($Checkheader)  
                    <div class="sm:col-span-10">  
                      <div class="rounded-md bg-red-50 p-4">
                          <div class="flex">
                            <div class="flex-shrink-0">
                              <!-- Heroicon name: solid/x-circle -->
                              <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                              </svg>
                            </div>
                            <div class="ml-3">
                              <h3 class="text-sm font-medium text-red-800">Error</h3>
                              <div class="mt-2 text-sm text-red-700">
                                <ul role="list" class="list-disc pl-5 space-y-1">
                                  <li>Invalid Template</li>
                                 
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div>
                     </div> 
                     @endif      

                     <div class="mt-2  grid grid-cols-1 gap-y-2 gap-x-12 sm:grid-cols-1">
                   

                        <div class="sm:col-span-10">
                            <label for="name" class="block text-sm font-medium text-gray-700">
                                Title
                            </label>
                            <div class="mt-1">
                                <input id="titlename" wire:model="title" type="text" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" >
                              
                            </div>
                             @error('title') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>



                          <div class="sm:col-span-10">
                            <label for="name" class="block text-sm font-medium text-gray-700">
                                Firstname
                            </label>
                            <div class="mt-1">
                                <input id="firstname" wire:model="firstname" type="text" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" >
                              
                            </div>
                             @error('firstname') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>


                          <div class="sm:col-span-10">
                            <label for="name" class="block text-sm font-medium text-gray-700">
                                Lastname
                            </label>
                            <div class="mt-1">
                                <input id="lastname" wire:model="lastname" type="text" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" >
                              
                            </div>
                             @error('lastname') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>

                          <div class="sm:col-span-10">
                            <label for="name" class="block text-sm font-medium text-gray-700">
                                mobilenumber
                            </label>
                            <div class="mt-1">
                                <input id="lastname" wire:model="mobilenumber" type="text" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" >
                              
                            </div>
                             @error('mobilenumber') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>

                          <div class="sm:col-span-10">
                            <label for="name" class="block text-sm font-medium text-gray-700">
                                Companyname
                            </label>
                            <div class="mt-1">
                                <input id="companyname" wire:model="companyname" type="text" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" >
                              
                            </div>
                             @error('companyname') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>



                    </div> 
                         
                          <div class="bg-gray-50 sm:flex sm:flex-row-reverse mt-2">
                                    <button wire:click="closeModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                  Cancel
                                  </button>
                                 <div wire:loading.remove wire:target="btnsave">
                                     <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"  wire:click="btnsave()">Update</button>
                                   </div>  
                                  <div wire:loading wire:target="btnsave">
                                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">processing....
                                         <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                      </svg>
                                    </button>
                                  </div> 

                                    
                              </div>
                          </div>
                        </div>
                  </div>
            </div>
          </div>  
        </div>  
        @endif
  @if($isOpen && $action=='create')
         <div class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true"  @click.away="closeModal()">
                  <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                  
                  <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                  <!-- This element is to trick the browser into centering the modal contents. -->
                  <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>


                  <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" @click.away="open=false">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                      <div class="">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                          <h2 class="pb-5 text-xl leading-6 font-medium text-gray-900 lg:border-b lg:border-gray-200" id="modal-title">
                            Upload file
                          </h2>

                     @if($Checkheader)  
                    <div class="sm:col-span-10">  
                      <div class="rounded-md bg-red-50 p-4">
                          <div class="flex">
                            <div class="flex-shrink-0">
                              <!-- Heroicon name: solid/x-circle -->
                              <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                              </svg>
                            </div>
                            <div class="ml-3">
                              <h3 class="text-sm font-medium text-red-800">Error</h3>
                              <div class="mt-2 text-sm text-red-700">
                                <ul role="list" class="list-disc pl-5 space-y-1">
                                  <li>Invalid Template</li>
                                 
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div>
                     </div> 
                     @endif      

                     <div class="sm:col-span-10">
                        <div x-cloak x-data="{ isUploading: false, progress: 0, success: false, error:false }" 
                          x-on:livewire-upload-start="isUploading = true"
                          x-on:livewire-upload-finish="isUploading = false,success = true" 
                          x-on:livewire-upload-error="isUploading = false,error= true"
                          x-on:livewire-upload-progress="progress = $event.detail.progress">

                             <label for="email" class="block text-sm font-medium text-gray-700">FILE</label>
                             <div class="mt-1  flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                               <input type="file"  class="" wire:model="csvfile">
                             </div>

                             <div class="mt-5 ">
                               <div x-cloak x-show="isUploading"  class="relative pt-1">
                                 <div class="text-center text-gray-700">
                                   Please wait while uploading the file .. <input x-bind:value="`${progress}%`" disabled style="width: 60px;">
                                 </div>
                                 <div  class="flex h-2 overflow-hidden text-xs bg-purple-200 rounded progress">
                                   <div x-bind:style="`width:${progress}%`"
                                     class="flex flex-col justify-center text-center text-white shadow-none whitespace-nowrap bg-custom-pink"
                                   ></div>
                                 </div>
                               </div>
                               <p x-show="success" class="text-sm font-bold text-center text-gray-800 text-custom-pink">File Upload Complete</p> 
                                <p x-show="error" class="text-sm font-bold text-center text-red-800">
                                    *Error to upload the file
                                  
                                </p> 
                             </div>

                        </div>
                          @error('csvfile') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div> 
                         
                          <div class="bg-gray-50 sm:flex sm:flex-row-reverse">
                                    <button wire:click="closeModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                  Cancel
                                  </button>
                                 <div wire:loading.remove wire:target="importdata">
                                     <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"  wire:click="importdata()">Upload</button>
                                   </div>  
                                  <div wire:loading wire:target="importdata">
                                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">processing....
                                         <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                      </svg>
                                    </button>
                                  </div> 

                                    
                              </div>
                          </div>
                        </div>
                  </div>
            </div>
          </div>  
        </div>  
        @endif


 @if($isOpen && $action=='delete')
         <div class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true"  @click.away="closeModal()">
                  <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                  
                  <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                  <!-- This element is to trick the browser into centering the modal contents. -->
                  <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>


                  <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" @click.away="open=false">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                      <div class="">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                          <h2 class="pb-5 text-xl leading-6 font-medium text-gray-900 lg:border-b lg:border-gray-200" id="modal-title">
                            Are you sure
                          </h2>

                         
                          <div class="bg-gray-50 sm:flex sm:flex-row-reverse">
                                    <button wire:click="closeModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                  Cancel
                                  </button>
                                 <div wire:loading.remove wire:target="btndelete">
                                     <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"  wire:click="btndelete()">Delete</button>
                                   </div>  
                                  <div wire:loading wire:target="btndelete">
                                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">processing....
                                         <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                      </svg>
                                    </button>
                                  </div> 

                                    
                              </div>
                          </div>
                        </div>
                  </div>
            </div>
          </div>  
        </div>  
        @endif

</div>
