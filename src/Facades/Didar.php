<?php

namespace MeysamHosseini\Didar\Facades;

use Illuminate\Support\Facades\Facade;


/**
 * @method static string getToken()
 * @method static void setToken(string $token)
 * @method static string getEndpoint()
 * @method static void setEndpoint(string $end_point)
 * @method static string makeUrl()
 * @method static array searchAll(string $Keyword, array $Types = ["contact", "company", "deal", "case", "attachment"])
 * @method static array dealList()
 * @method static array dealSave(string $ContactId,string $Title, array $Data = [])
 * @method static array dealUpdate(string $DealId,string $Title, array $Data = [])
 * @method static array cardList()
 * @method static array activityType()
 * @method static array customfieldList()
 * @method static array activityList(array $Data = [], int $From = 0, int $Limit = 30)
 * @method static array saveActivity(string $DealId, string $Title, array $Data = [], array $NewAttachments = [])
 * @method static array saveNote(string $DealId, string $ResultNote, array $Data = [], array $NewAttachments = [])
 * @method static array searchActivity(array $Data = [], int $From = 0, int $Limit = 30)
 * @method static array operatorList()
 * @method static array saveCustomer(array $Data = [])
 * @method static array searchPerson(string $Keywords, array $Data = [], int $From = 0, int $Limit = 30)
 * @method static array searchCompany(string $Keywords, array $Data = [], int $From = 0, int $Limit = 30)
 */
class Didar extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Didar';
    }
}
