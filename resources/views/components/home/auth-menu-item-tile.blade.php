@includeWhen (Auth::user() && Auth::user()->can($ability, $args), 'components.home.menu-item-tile')
