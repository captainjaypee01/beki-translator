<?php

Breadcrumbs::for('admin.record.word.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('Word Management'), route('admin.record.word.index'));
});

Breadcrumbs::for('admin.record.word.create', function ($trail) {
    $trail->parent('admin.record.word.index');
    $trail->push(__('Create Word'), route('admin.record.word.create'));
});

Breadcrumbs::for('admin.record.word.edit', function ($trail, $id) {
    $trail->parent('admin.record.word.index');
    $trail->push(__('Edit Word'), route('admin.record.word.edit', $id));
});

Breadcrumbs::for('admin.record.word.show', function ($trail, $id) {
    $trail->parent('admin.record.word.index');
    $trail->push(__('Edit Word'), route('admin.record.word.show', $id));
});