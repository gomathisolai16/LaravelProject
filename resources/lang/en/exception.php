<?php

/**
 * Keep application exception messages here
 *
 * @return array
 */
return [

    'relation' => 'Relation :relation not found.',
    'filter' => 'Filter :filter not found.',
    'field' => 'Field :field dose not exists or not selectable.',
    'table' => 'Table :table not found.',
    'unique' => ':item\'s :field ":key" already in use. Please use another :field.',
    'unique_for_user' => ':item\'s :field ":key" already taken for user ":name". Please use another :field.',

    'propMissing' => 'Property :prop not set correctly',
    'settingKeyNotFound' => 'Undefined key :key for settings',
    'sortColsMissing' => 'Sortable columns not set correctly',

    'notAllowedOrderType' => 'Only asc or desc ordering can be applied',
    'canNotCombine' => 'You can not use :0 and :1 together.',
    'canNotSave' => 'Unable to save :item.',
    'canNotUpdate' => 'Unable to update :item with ID :id.',
    'canNotDelete' => 'Unable to delete :item with ID :id.',
    'invalidBase64' => 'Invalid base64 data.',
    'canNotSaveFile' => 'Could not save the file.',

    'modelNotFound' => 'Model :model not found.',
    'requestNotFound' => 'Model :request not found.',
    'recordNotFound' => ':item with ID :id not found.',

    'access' => [
        'admin' => 'Only administrator can add new category.',
        'permission' => "You don't have permission for this action."
    ]
];