<?php

/**
 * Keep application success && error messages here
 *
 * @return array
 */
return [

    'emailNotFound' => 'Email not found in database.',

    'status' => [
        'suspended' => 'Suspended: Invalid user, please contact your account manager',
        'canceled' => 'Canceled: Invalid user, please contact your account manager',
    ],

    'image' => [
        'maxSize' => 'Image size should not be greater then :size kb.',
        'minSize' => 'Image size should not be less than :size kb.',
        'minWidth' => 'Image width should not be less than :width px.',
        'minHeight' => 'Image height should not be less than :height px.',
        'maxWidth' => 'Image height should not be greater than :width px.',
        'maxHeight' => 'Image height should not be greater than :height px.',
    ],

    'saved' => ':item has been saved successfully.',
    'updated' => ':item with ID :id has been updated.',
    'deleted' => ':item with ID :id has been deleted.',
    'deletedFrom' => ':item with ID :id has been removed from :section.',
    'themeNotFound' => 'Theme :item has not been found',
    'subscriptionNotValid' => 'Subscription field not provided! Please select a valid subscription level from dropdown.',
    'attrNotFound' => 'Parameters [ :item ] have not been found in the request',
    'itemExists' => ':itemCode :item already exist',
    'categoryNotFound' => 'Category with id :id not found in our database',

];