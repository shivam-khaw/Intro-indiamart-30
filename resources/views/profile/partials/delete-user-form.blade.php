
<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            Delete Account
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.
        </p>
    </header>

    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal"">
        Delete Account
    </button>

    <!-- Bootstrap Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="confirmDeleteModalLabel">Are you sure you want to delete your account?</h2>
 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>                </div>
                <div class="modal-body">
                    <p>
                        Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.
                    </p>

                    <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                        <!-- CSRF Token -->
                        @csrf

                        <!-- HTTP Method Spoofing -->
                        @method('delete')

                        <div class="mb-3">
                            <label for="password" class="form-label sr-only">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">

                            <!-- Validation Error Message -->
                            @if ($errors->userDeletion->has('password'))
                                <div class="text-danger mt-2">
                                    {{ $errors->userDeletion->first('password') }}
                                </div>
                            @endif
                        </div>

                        <div class="mt-6 flex justify-end">
                            <button type="button" class="btn btn-secondary"  data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Delete Account</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
