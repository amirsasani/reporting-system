# Reporting System
To create a new report you should have a `User` or `Authenticable` instance.  
First create a new instance of `ReportSystem` and pass the `Authenticable` instance.  
```php
$reportSystem = new ReportSystem($user);
```

Every report has `details`, details are classes that implement `Details` interface. `NicknameDetails` is a sample details class that uses for reports for nicknames.  

To submit a report you should call `new` method from `ReportSystem`:  
```php
$resourceType = 'nickname';

$details = new NicknameDetails();
$details->setId(2);
$details->setDescription("user's nickname is against rules");
$details->setNickname("badusername");
$details->setSubject("nickname is not valid");

$newReport = $reportSystem->new($resourceType, $details);
```

Reports default status is `1` which means `pending`. 

### Report Statuses
| **Status** | **Meaning** |        **Usage**        |
|:----------:|:-----------:|:-----------------------:|
| 1          | Pending     | Report::STATUS_PENDING  |
| 2          | Accepted    | Report::STATUS_ACCEPTED |
| 3          | Rejected    | Report::STATUS_REJECTED |


## Blacklist
To add a word or a string to Blacklist, you can call the `addToBlacklist` of `ReportSystem` class:  
```php
$name = 'badusername';
$type = User::class;

ReportSystem::addToBlacklist($name, $type);
```

And in order to remove a record from Blacklist follow the code below:  
```php
ReportSystem::removeFromBlacklist($blacklist->id);
```