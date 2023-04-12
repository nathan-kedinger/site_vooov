<?php
// Adding a read array for each entity to avoid upwrighting id but being able to read them

$tabMessagesRead = [
    $id = "id",
    $sender = "sender_id",
    $receiver = "receiver_id",
    $uuid = "uuid",
    $conversation_uuid = "conversation_uuid",
    $body = "body",
    $seen = "seen",
    $send_at = "send_at"
];

$tabMessages = [
    $sender = "sender_id",
    $receiver = "receiver_id",
    $uuid = "uuid",
    $conversation_uuid = "conversation_uuid",
    $body = "body",
    $seen = "seen",
    $send_at = "send_at"
];

$tabConversationsRead = [
    $id = "id",
    $sender_id = "sender_id",
    $receiver_id = "receiver_id",
    $uuid = "uuid",
    $title = "title",
    $created_at = "created_at",
    $updated_at = "updated_at",
];

$tabConversations = [
    $sender_id = "sender_id",
    $receiver_id = "receiver_id",
    $uuid = "uuid",
    $title = "title",
    $created_at = "created_at",
    $updated_at = "updated_at",
];

$tabRecordsRead = [
    $id = "id",
    $artist_id= "artist_id",
    $categories_id = "categories_id",
    $voice_style_id = "voice_style_id",
    $uuid = "uuid",
    $title= "title",
    $length= "length",
    $number_of_plays= "number_of_plays",
    $number_of_moons= "number_of_moons",
    $description= "description",
    $created_at= "created_at",
    $updated_at= "updated_at"
];

$tabRecords = [
    $artist_id= "artist_id",
    $categories_id = "categories_id",
    $voice_style_id = "voice_style_id",
    $uuid = "uuid",
    $title= "title",
    $length= "length",
    $number_of_plays= "number_of_plays",
    $number_of_moons= "number_of_moons",
    $description= "description",
    $created_at= "created_at",
    $updated_at= "updated_at"
];

$tabUsersRead = [
    $id = "id",
    $email = "email",
    $roles = "roles",
    $password = "password",
    $is_verified = "is_verified",
    $uuid = "uuid",
    $pseudo = "pseudo",
    $name = "name",
    $firstname = "firstname",
    $birthday = "birthday",
    $phone = "phone",
    $description = "description",
    $number_of_followers = "number_of_followers",
    $number_of_moons = "number_of_moons",
    $number_of_friends = "number_of_friends",
    $url_profile_picture = "url_profile_picture",
    $sign_in = "sign_in",
    $last_connection = "last_connection"
];

$tabUsers = [
    $email = "email",
    $roles = "roles",
    $password = "password",
    $is_verified = "is_verified",
    $uuid = "uuid",
    $pseudo = "pseudo",
    $name = "name",
    $firstname = "firstname",
    $birthday = "birthday",
    $phone = "phone",
    $description = "description",
    $number_of_followers = "number_of_followers",
    $number_of_moons = "number_of_moons",
    $number_of_friends = "number_of_friends",
    $url_profile_picture = "url_profile_picture",
    $sign_in = "sign_in",
    $last_connection = "last_connection"
];

$tabFriendsRead = [
    $id = "id",
    $uuid = "uuid",
    $user1 = "user1",
    $user2 = "user2",

];

$tabFriends = [
    $uuid = "uuid",
    $user1 = "user1",
    $user2 = "user2",

];

$tabAudioRecordCategoriesRead = [
    $id = "id",
    $name => "name"
];

$tabAudioRecordCategories = [
    $name => "name"
];

$tabVoiceStyleRead = [
    $id ="id",
    $voice_style = "voice_style"
];

$tabVoiceStyle = [
    $voice_style = "voice_style"
];