<login inline-template>
    <modal classes="v--modal has-text-centered" name="login" transition="bounce" height="auto" :scrollable="true">
        <h3 class="title has-text-grey">Login</h3>
        <p class="subtitle has-text-grey">Please login to proceed.</p>

        <div id="login-box">
            <figure id="login-avatar" class="avatar"> <img src="{{ asset('logo.png') }}"> </figure>

            <form @submit.prevent="login" @keydown="feedback = ''">

                {{ csrf_field() }}

                <div class="field">
                    <div class="control has-icons-left">
                        <input
                            id="email"
                            name="email"
                            class="input is-medium"
                            type="text"
                            placeholder="Username / E-Mail"
                            autofocus
                            required
                            value="{{ old('email') }}"
                            v-model="form.email"
                        >

                        {!! icon('fas fa-user', 'is-left') !!}
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
                        >

                        {!! icon('fas fa-key', 'is-left') !!}
                    </div>
                </div>

                </br>

                <div class="buttons is-centered">
                    <button type="submit" class="button is-info is-medium" :class="loading ? 'is-loading' : ''" :disabled="cantSendLogin()">Login</button>
                    <button class="button is-medium" @click="register" :disabled="{{ json_encode(onMaintenance()) }}">Register</button>
                </div>

                <div class="message is-danger" v-if="feedback">
                    <div class="message-body" v-text="feedback"></div>
                </div>
            </form>
        </div>
    </modal>
</login>

<a class="navbar-item" @click="$modal.show('login')">Login</a>