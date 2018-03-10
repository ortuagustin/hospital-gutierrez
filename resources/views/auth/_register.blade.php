<register inline-template>
    <modal classes="v--modal has-text-centered" name="register" transition="bounce" height="auto" :scrollable="true">
        <p class="title has-text-grey">Register</p>
        <p class="subtitle has-text-grey">Create a new User</p>

        <form @submit.prevent="register">

            {{ csrf_field() }}

            <div class="field">
                <div class="control has-icons-left">
                    <input
                        id="name"
                        name="name"
                        class="input is-medium"
                        type="text"
                        placeholder="Username"
                        autofocus
                        required
                        value="{{ old('name') }}"
                        v-model="form.name"
                        @keydown="errors.name = ''"
                    >

                    <span v-if="errors.name" v-text="errors.name[0]" class="help has-text-weight-bold has-text-danger"></span>

                    {!! icon('fas fa-user', 'is-left') !!}
                </div>
            </div>

            <div class="field">
                <div class="control has-icons-left">
                    <input
                        id="email"
                        name="email"
                        class="input is-medium"
                        type="text"
                        placeholder="E-Mail"
                        required
                        value="{{ old('email') }}"
                        v-model="form.email"
                        @keydown="errors.email = ''"
                    >

                    <span v-if="errors.email" v-text="errors.email[0]" class="help has-text-weight-bold has-text-danger"></span>

                    {!! icon('fas fa-envelope', 'is-left') !!}
                </div>
            </div>

            <div class="field">
                <div class="control has-icons-left">
                    <input
                        id="password"
                        name="password"
                        class="input is-medium"
                        type="password"
                        placeholder="Password"
                        required
                        v-model="form.password"
                        @keydown="errors.password = ''"
                    >

                    <span v-if="errors.password" v-text="errors.password[0]" class="help has-text-weight-bold has-text-danger"></span>

                    {!! icon('fas fa-key', 'is-left') !!}
                </div>
            </div>

            <div class="field">
                <div class="control has-icons-left">
                    <input
                        id="password_confirmation"
                        name="password_confirmation"
                        class="input is-medium"
                        type="password"
                        placeholder="Confirm your Password"
                        required
                        v-model="form.password_confirmation"
                        @keydown="errors.password_confirmation = ''"
                    >

                    {!! icon('fas fa-key', 'is-left') !!}
                </div>
            </div>

            <br>

            <div class="buttons is-centered">
                <button type="submit" class="button is-info is-medium" :class="loading ? 'is-loading' : ''" :disabled="loading">Register</button>
                <button class="button is-medium" @click="login">Have an account?</button>
            </div>
        </form>
    </modal>
</register>

<a class="navbar-item" @click="$modal.show('register')">Register</a>
