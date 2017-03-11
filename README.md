# php-dal
Data access layer for PHP projects. For use as sub repository (component) throughout PHP projects. Trying to make this as plug and play as possible, so all projects maintain good connection design.

Current database connector is PDO. PDO seems to be the favoured connection API so will stick to this. 

Usage scenario:

Use with repository pattern. Implement a Model, ModelRepository which implements a interface for CRUD functions.
