<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register | UITS Alumni Portal</title>

    <link rel="stylesheet" href="{{ asset('css/adminlte/adminlte.min.css') }}">
</head>
<body>
{{--<x-slot name="logo">--}}
{{--        <x-application-logo class="w-20 h-20 fill-current text-gray-500"/>--}}
{{--</x-slot>--}}

<!-- Validation Errors -->
{{--<x-auth-validation-errors class="mb-4" :errors="$errors"/>--}}


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3 class="mt-2 text-center">Register | UITS Alumni Portal</h3>

            @if(session()->get('success'))
            <p class="text-center alert alert-success">{{ session()->get('success') }} </p>
            @endif

            <div class="form-area">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->

                    <div class="row">
                        <div class="form-group col-md-6 mt-1">
                            <x-label for="name" :value="__('Name')"/> <span class="text-danger">*</span>

                            <input id="name" class="form-control" type="text" name="name"
                                   value="{{ old('name') }}"
                                   autofocus placeholder="Full Name"/>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Email Address -->
                        <div class="form-group col-md-6 mt-1">
                            <x-label for="email" :value="__('Email')"/> <span class="text-danger">*</span>

                            <input id="email" class="form-control" type="email" name="email"
                                   value="{{ old('email') }}"
                                 placeholder="yourname@gmail.com"/>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6 mt-1">
                            <x-label for="password" :value="__('Password')"/> <span class="text-danger">*</span>

                            <input id="password" class="form-control"
                                   type="password"
                                   name="password"
                                 autocomplete="new-password"
                                   placeholder="Your Password"/>
                                   @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                   @enderror
                                </div>

                        <!-- Confirm Password -->
                        <div class="form-group col-md-6 mt-1">
                            <x-label for="password_confirmation" :value="__('Confirm Password')"/> <span class="text-danger">*</span>

                            <input id="password_confirmation" class="form-control"
                                   type="password"
                                   name="password_confirmation"
                                   placeholder="Confirm Your Password"/>
                                   @error('password_confirmation')
                                        <span class="text-danger">{{ $message }}</span>
                                   @enderror
                        </div>
                    </div>


                    <!-- Password -->

                    <div class="row">
                        <div class="form-group col-md-6 mt-1">
                            <label for="batch_number">Batch No.</label> <span class="text-danger">*</span>

                            <select style="width: 100%;" class="form-control" name="batch_number" id="batch_number">
                                <option value="" disabled>Select your option</option>
                                @foreach(generateBatchNumbers() as $key => $batchNumber)
                                    <option @if (old('batch_number') == $key) selected @endif value="{{ $key }}">
                                        {{ $batchNumber }}
                                    </option>
                                @endforeach
                            </select>
                            @error('batch_number')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6 mt-1">
                            <label for="passing_year">Passing Year.</label> <span class="text-danger">*</span>

                            <select style="width: 100%;" class="form-control" name="passing_year" id="passing_year">
                                <option value="" disabled>Select your option</option>
                                @foreach(generatePassingYears() as $key => $passingYear)
                                    <option @if (old('passing_year') == $key) selected @endif value="{{ $key }}">{{ $passingYear }}</option>
                                @endforeach
                            </select>
                            @error('passing_year')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                    <div class="row">
                        <div class="form-group col-md-6 mt-1">
                            <label for="department_id">Department</label> <span class="text-danger">*</span>

                            <select style="width: 100%;" class="form-control" name="department_id" id="department_id">
                                <option value="" disabled>Select your option</option>
                                @foreach(getDepartments() as $key => $department)
                                    <option @if (old('department_id') == $key) selected @endif value="{{ $key }}">{{ $department }}</option>
                                @endforeach
                            </select>
                            @error('department_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6 mt-1">
                            <label for="student_id_number">Student ID</label> <span class="text-danger">*</span>

                            <input style="width: 100%;" class="form-control" type="text"
                                    value="{{ old('student_id_number') }}"
                                   name="student_id_number" id="student_id_number"
                                   placeholder="Eg. 1791015123">
                            @error('student_id_number')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6 mt-1">
                            <label for="phone">Phone</label> <span class="text-danger">*</span>

                            <input style="width: 100%;" class="form-control" type="text"
                                   name="phone" id="phone"
                                    value="{{ old('phone') }}"
                                   placeholder="Eg. 01711111111">
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                        </div>

                        <div class="form-group col-md-6 mt-1">
                            <label for="address">Address</label>

                            <input style="width: 100%;" class="form-control" type="text"
                                   name="address" id="address"
                                    value="{{ old('address') }}"
                                   placeholder="Eg. Shewrapara, Mirpur, Dhaka">
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            {{--                            <div class="flex items-center justify-end mt-1">--}}


                            <div class="btn" style="width: 100%;">
                                <button class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>

                            <a style="text-align: center; display: block;" class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                                {{ __('Already registered?') }}
                            </a>
                            {{--                            </div>--}}
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>

{{--<x-guest-layout>--}}
{{--    <x-auth-card>--}}

{{--    </x-auth-card>--}}
{{--</x-guest-layout>--}}
