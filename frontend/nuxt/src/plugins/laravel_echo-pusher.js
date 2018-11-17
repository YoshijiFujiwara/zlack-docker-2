import LaravelEcho from "laravel-echo";

export default ({ app, store, redirect, storategy }) => {
  // const token = store.getters['auth/token'];
  // const token = app.$auth.getToken(storategy);

  window.Pusher = require('pusher-js');

  window.Echo = new LaravelEcho({
    // authEndpoint: 'http://localhost/broadcasting/auth',
    broadcaster: 'pusher',
    key: '4d4a8e9e20e8237cf659',
    cluster: 'ap1',
    // auth: {
    //   headers: {
    //     Authorization: `Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC96bGFja19iYWNrZW5kXzEudGVzdFwvYXBpXC9sb2dpbiIsImlhdCI6MTU0MTYzMDk3NSwiZXhwIjoxNTQxNjM0NTc1LCJuYmYiOjE1NDE2MzA5NzUsImp0aSI6IjFQT0pvMHFmUFc3NjFqaHMiLCJzdWIiOjEsInBydiI6Ijg3ZTBhZjFlZjlmZDE1ODEyZmRlYzk3MTUzYTE0ZTBiMDQ3NTQ2YWEifQ.lxpWoLXMVEnun9SDtJPt5xG1uUjPYMSdd5rbEQoZ-F8`
    //   },
    // },
  });
}
