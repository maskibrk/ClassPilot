<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <flux:sidebar sticky collapsible="mobile" class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-800">
            <flux:sidebar.header>
                <x-app-logo :sidebar="true" href="{{ route('dashboard') }}" wire:navigate />
                <flux:sidebar.collapse class="lg:hidden" />
            </flux:sidebar.header>

<flux:sidebar.nav>

    @if(auth()->user()->isAdmin())

        <flux:sidebar.group :heading="__('Admin')" class="grid">

            <flux:sidebar.item
                icon="home"
                :href="route('admin.dashboard')"
                :current="request()->routeIs('admin.dashboard')"
                wire:navigate>
                Dashboard
            </flux:sidebar.item>


            <flux:sidebar.item
                icon="users"
                :href="route('admin.students.index')"
                :current="request()->routeIs('admin.students.*')"
                wire:navigate>
                Students
            </flux:sidebar.item>


            <flux:sidebar.item
                icon="user"
                :href="route('admin.teachers.index')"
                :current="request()->routeIs('admin.teachers.*')"
                wire:navigate>
                Teachers
            </flux:sidebar.item>


            <flux:sidebar.item
                icon="user-group"
                :href="route('admin.parents.index')"
                :current="request()->routeIs('admin.parents.*')"
                wire:navigate>
                Parents
            </flux:sidebar.item>

            <flux:sidebar.item
            icon="academic-cap"
            :href="route('admin.classes.index')"
            :current="request()->routeIs('admin.classes.*')"
            wire:navigate>
            Classes
            </flux:sidebar.item>


        </flux:sidebar.group>


    @elseif(auth()->user()->isTeacher())


        <flux:sidebar.group :heading="__('Teacher')" class="grid">


            <flux:sidebar.item
                icon="home"
                :href="route('teacher.dashboard')"
                :current="request()->routeIs('teacher.dashboard')"
                wire:navigate>
                Dashboard
            </flux:sidebar.item>


            <flux:sidebar.item
                icon="users"
                :href="route('teacher.students.index')"
                :current="request()->routeIs('teacher.students.*')"
                wire:navigate>
                My Students
            </flux:sidebar.item>

            <flux:sidebar.item
            icon="academic-cap"
            :href="route('teacher.classes.index')"
            :current="request()->routeIs('teacher.classes.*')"
            wire:navigate>
            My Classes
            </flux:sidebar.item>

            <flux:sidebar.item
                icon="document-text"
                :href="route('teacher.homeworks.index')"
                :current="request()->routeIs('teacher.homeworks.*')"
                wire:navigate>
                Homework
            </flux:sidebar.item>

        </flux:sidebar.group>


    @elseif(auth()->user()->isParent())


        <flux:sidebar.group :heading="__('Parent')" class="grid">


            <flux:sidebar.item
                icon="home"
                :href="route('parent.dashboard')"
                :current="request()->routeIs('parent.dashboard')"
                wire:navigate>
                Dashboard
            </flux:sidebar.item>


            <flux:sidebar.item
                icon="academic-cap"
                :href="route('parent.children.index')"
                :current="request()->routeIs('parent.children.*')"
                wire:navigate>
                My Children
            </flux:sidebar.item>


        </flux:sidebar.group>


    @elseif(auth()->user()->isStudent())


        <flux:sidebar.group :heading="__('Student')" class="grid">


            <flux:sidebar.item
                icon="home"
                :href="route('student.dashboard')"
                :current="request()->routeIs('student.dashboard')"
                wire:navigate>
                Dashboard
            </flux:sidebar.item>


            <flux:sidebar.item
            icon="users"
            :href="route('student.teachers.index')"
            :current="request()->routeIs('student.teachers.*')"
            wire:navigate>
            My Teachers
            </flux:sidebar.item>

            <flux:sidebar.item
            icon="academic-cap"
            :href="route('student.classes.index')"
            :current="request()->routeIs('student.classes.*')"
            wire:navigate>
            My Classes
            </flux:sidebar.item>

            <flux:sidebar.item
                icon="document-text"
                :href="route('student.homeworks.index')"
                :current="request()->routeIs('student.homeworks.*')"
                wire:navigate>
                Homework
            </flux:sidebar.item>

<flux:sidebar.item
    icon="document-check"
    :href="route('student.submissions.index')"
    :current="request()->routeIs('student.submissions.*')"
    wire:navigate>
    My Submissions
</flux:sidebar.item>

        </flux:sidebar.group>


    @endif

</flux:sidebar.nav>
            <flux:spacer />



            <x-desktop-user-menu class="hidden lg:block" :name="auth()->user()->name" />
        </flux:sidebar>

        <!-- Mobile User Menu -->
        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevron-down"
                />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <flux:avatar
                                    :name="auth()->user()->name"
                                    :initials="auth()->user()->initials()"
                                />

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <flux:heading class="truncate">{{ auth()->user()->name }}</flux:heading>
                                    <flux:text class="truncate">{{ auth()->user()->email }}</flux:text>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>
                            {{ __('Settings') }}
                        </flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item
                            as="button"
                            type="submit"
                            icon="arrow-right-start-on-rectangle"
                            class="w-full cursor-pointer"
                            data-test="logout-button"
                        >
                            {{ __('Log out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        {{ $slot }}

        @persist('toast')
            <flux:toast.group>
                <flux:toast />
            </flux:toast.group>
        @endpersist

        @fluxScripts
    </body>
</html>
