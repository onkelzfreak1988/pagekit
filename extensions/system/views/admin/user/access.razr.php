@style('user', 'system/css/user.css')
@script('user', 'system/js/user/access.js', ['requirejs'])

<div class="uk-grid" data-uk-grid-margin data-uk-grid-match>
    <div class="pk-sidebar uk-width-medium-1-4">
        <form id="js-access-level" class="uk-form" method="post">

            <ul class="pk-sortable" data-uk-sortable="{ maxDepth: 1, prefix: 'pk' }" data-update-url="@url.route('@system/accesslevel/priority')">
                @foreach (levels as lev)
                <li data-id="@lev.id">
                    <div class="pk-sortable-item uk-visible-hover@( lev == level ? ' pk-active' )">
                        <div class="pk-sortable-handle"></div>
                        @if (!lev.locked)
                        <ol class="uk-subnav pk-subnav-icon uk-hidden">
                            <li><a href="#" data-edit="@url.route('@system/accesslevel/save', ['id' => lev.id])" data-name="@lev.name" title="@trans('Edit')"><i class="uk-icon-pencil"></i></a></li>
                            <li><a href="#" data-action="@url.route('@system/accesslevel/delete', ['id' => lev.id])" data-confirm="@trans('Are you sure?')" title="@trans('Delete')"><i class="uk-icon-minus-circle"></i></a></li>
                        </ol>
                        @endif
                        <a href="@url.route('@system/accesslevel/index', ['id' => lev.id])">@lev.name</a>
                    </div>
                </li>
                @endforeach
            </ul>
            <hr>
            <a class="uk-button" href="#" data-edit="@url.route('@system/accesslevel/save', ['id' => 0])">@trans('Add Access Level')</a>
            @token()

        </form>
    </div>
    <div class="pk-content uk-width-medium-3-4">
        <form id="js-access-level-roles" class="uk-form" action="@url.route('@system/accesslevel/save', ['id' => level.id])" method="post">

            @if (level.id)
            <table class="uk-table uk-table-hover uk-table-middle">
                <thead>
                    <tr>
                        <th colspan="2">@trans('Roles')</th>
                    </tr>
                </thead>
                <tbody>
                    <input type="hidden" name="roles[]" value="">
                    @foreach (roles as role)
                    <tr>
                        <td>@role.name</td>
                        <td class="pk-table-width-minimum"><input type="checkbox" name="roles[]" value="@role.id"@( level.hasRole(role) ? ' checked' )@( level.locked ? ' disabled' )></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            @endif

            @token()

        </form>
    </div>
</div>

<div id="modal-access-level" class="uk-modal">
    <div class="uk-modal-dialog uk-modal-dialog-slide">

        <form class="uk-form" method="post">

            <p>
                <input class="uk-width-1-1 uk-form-large" type="text" name="name" value="" placeholder="@trans('Enter Access Level Name')">
            </p>

            <button class="uk-button uk-button-primary" type="submit">@trans('Save')</button>
            <button class="uk-button uk-modal-close" type="submit">@trans('Cancel')</button>

            @token()

        </form>

    </div>
</div>