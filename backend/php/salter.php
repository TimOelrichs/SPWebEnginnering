<?PHP
$SALT = '#my_super_S3CR3T!';

function salter($x)
{
    global $SALT;
    return hash("sha384", $x . $SALT);
}
