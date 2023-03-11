<?php

namespace App\Helpers;

use Carbon\Carbon;
use App\Models\General\Setting;
use App\Models\General\Branch;

use App\Models\Customer;
use App\Models\CustomerInternetBanking;

use App\Models\Saving\SavingAccount;
use App\Models\Saving\SavingActivity;
use App\Models\Saving\SavingApplication;
use App\Models\Saving\SavingAccountClosing;

use App\Models\Deposit\DepositAccount;
use App\Models\Deposit\DepositActivity;
use App\Models\Deposit\DepositApplication;

use App\Models\Loan\LoanAccount;
use App\Models\Loan\LoanProduct;

use App\Models\Accounting\AccountingAccount;
use App\Models\Accounting\AccountingTag;

use Illuminate\Support\Facades\Cache;
use Spatie\Activitylog\Models\Activity;
use DB;
use H;

trait ModelHelper
{

    public static function setting($key, $default = null, $cache = true, $label = null, $input_type = null, $visible = null, $sequence = null)
    {
        return Setting::key($key, $default, $label, $input_type, $visible, $sequence, $cache);
    }

    public static function setSetting($key, $value, $cache = true)
    {
        return Setting::setValue($key, $value, $cache);
    }

    public static function defaultBranchId()
    {
        $default_branch =  Branch::default()->first();
        return $default_branch ? $default_branch->id : null;
    }

    public static function analyticsCustomerCount()
    {
        return Cache::remember('analytics_customer_count', 5, function() {
            $customer_count = Customer::active()->count();
            return $customer_count;
        });
    }

    public static function analyticsCustomerInternetBankingCount()
    {
        return Cache::remember('analytics_customer_internet_banking_count', 5, function() {
            $customer_count = CustomerInternetBanking::active()->count();
            return $customer_count;
        });
    }

    public static function analyticsSavingAccountCount()
    {
        return Cache::remember('analytics_saving_account_count', 5, function() {
            $saving_count = SavingAccount::count();
            return $saving_count;
        });
    }

    public static function analyticsDepositAccountCount()
    {
        return Cache::remember('analytics_deposit_account_count', 5, function() {
            $deposit_count = DepositAccount::count();
            return $deposit_count;
        });
    }

    public static function analyticsSavingAccountBalanceTotal()
    {
        return Cache::remember('analytics_saving_account_balance_total', 5, function() {
            $saving_current_balance_total = SavingAccount::sum('current_balance');
            return $saving_current_balance_total;
        });
    }

    public static function analyticsDepositAccountBalanceTotal()
    {
        return Cache::remember('analytics_deposit_account_balance_total', 5, function() {
            $deposit_current_balance_total = DepositAccount::sum('current_balance');
            return $deposit_current_balance_total;
        });
    }

    public static function analyticsTodaySavingApplicationCount()
    {
        return Cache::remember('analytics_today_saving_application_count', 5, function() {
            $application_count = SavingApplication::today()->count();
            return $application_count;
        });
    }

    public static function analyticsTodayDepositApplicationCount()
    {
        return Cache::remember('analytics_today_deposit_application_count', 5, function() {
            $application_count = DepositApplication::today()->count();
            return $application_count;
        });
    }

    public static function analyticsTodaySavingActivityCount()
    {
        return Cache::remember('analytics_today_saving_activity_count', 5, function() {
            $data = SavingActivity::whereNotNull('teller_session_id')->today()->count();
            return $data;
        });
    }

    public static function analyticsTodayDepositActivityCount()
    {
        return Cache::remember('analytics_today_deposit_activity_count', 5, function() {
            // $data = DepositActivity::whereNotNull('teller_session_id')->today()->count();
            $data = DepositActivity::today()->count();
            return $data;
        });
    }

    public static function analyticsTodaySavingClosingCount()
    {
        return Cache::remember('analytics_today_saving_closing_count', 5, function() {
            $data = SavingAccountClosing::today()->count();
            return $data;
        });
    }

    public static function analyticsTodayUserLoggedInCount()
    {
        return Cache::remember('analytics_today_user_login_count', 5, function() {
            $user_count = Activity::where('log_name', 'authentication')
                ->where('description', 'like', '%logged in')
                ->whereDate('created_at', H::today())
                ->distinct()->count('causer_id');
            return $user_count;
        });
    }

    public static function analyticsTodayFailedLoggedInCount()
    {
        return Cache::remember('analytics_today_failed_login_count', 5, function() {
            $failed_count = Activity::where('log_name', 'authentication')
                ->where('description', 'like', 'Failed login captured')
                ->whereDate('created_at', H::today())->count();
            return $failed_count;
        });
    }

    public static function analyticsLoanCollCurrentAmount()
    {
        return Cache::remember('analytics_loan_coll_current_amount', 5, function() {
            $loan_amount = LoanAccount::CollCurrent()->sum('loan_amount');
            return $loan_amount;
        });
    }

    public static function analyticsLoanCollCurrentCount()
    {
        return Cache::remember('analytics_loan_coll_current_count', 5, function() {
            $loan_count = LoanAccount::CollCurrent()->count();
            return $loan_count;
        });
    }

    public static function analyticsLoanCollSpecialMentionAmount()
    {
        return Cache::remember('analytics_loan_coll_special_mention_amount', 5, function() {
            $loan_amount = LoanAccount::CollSpecialMention()->sum('loan_amount');
            return $loan_amount;
        });
    }

    public static function analyticsLoanCollSpecialMentionCount()
    {
        return Cache::remember('analytics_loan_coll_special_mention_count', 5, function() {
            $loan_count = LoanAccount::CollSpecialMention()->count();
            return $loan_count;
        });
    }

    public static function analyticsLoanCollSubstandardAmount()
    {
        return Cache::remember('analytics_loan_coll_substandard_amount', 5, function() {
            $loan_amount = LoanAccount::CollSubstandard()->sum('loan_amount');
            return $loan_amount;
        });
    }

    public static function analyticsLoanCollSubstandardCount()
    {
        return Cache::remember('analytics_loan_coll_substandard_count', 5, function() {
            $loan_count = LoanAccount::CollSubstandard()->count();
            return $loan_count;
        });
    }

    public static function analyticsLoanCollDoubtfulAmount()
    {
        return Cache::remember('analytics_loan_coll_doubtful_amount', 5, function() {
            $loan_amount = LoanAccount::CollDoubtful()->sum('loan_amount');
            return $loan_amount;
        });
    }

    public static function analyticsLoanCollDoubtfulCount()
    {
        return Cache::remember('analytics_loan_coll_doubtful_count', 5, function() {
            $loan_count = LoanAccount::CollDoubtful()->count();
            return $loan_count;
        });
    }

    public static function analyticsLoanCollBadAmount()
    {
        return Cache::remember('analytics_loan_coll_bad_amount', 5, function() {
            $loan_amount = LoanAccount::CollBad()->sum('loan_amount');
            return $loan_amount;
        });
    }

    public static function analyticsLoanCollBadCount()
    {
        return Cache::remember('analytics_loan_coll_bad_count', 5, function() {
            $loan_count = LoanAccount::CollBad()->count();
            return $loan_count;
        });
    }

    public static function analyticsLoanMount()
    {
        return Cache::remember('analytics_loan_amount', 5, function() {
            $loan_amount = LoanAccount::sum('loan_amount');;
            return $loan_amount;
        });
    }

    public static function analyticsLoanCountPerProduct()
    {
        return Cache::remember('analytics_loan_count_per_product', 5, function() {
            $loan_products = LoanProduct::active()->get();
            $loan_product_counts = [];
            foreach ($loan_products as $product) {
                $loan_product_counts[] = [
                    'product' => $product->fullname,
                    'count' => $product->loan_accounts()->count()
                ];
            }
            return $loan_product_counts;
        });
    }

    public static function analyticsAccountingTagSaldo($tag_name, $end_date = null)
    {
        if($end_date == null) {
            $end_date = H::today();
        }
        $tag = AccountingTag::where('name', $tag_name)->first();
        return $tag ? $tag->currentBalanceAtDate($end_date) : 0.00;
    }

    public static function analyticsAccountingLiquidity($end_date = null)
    {
        $tags = [
            'KAS' => 'Kas',
            'ABAGIRO' => 'Giro',
            'ABATABUNGAN' => 'Penempatan pada Bank Lain Tabungan',
            'ABADEPOSITO' => 'Penempatan pada Bank Lain Deposito',
            'BAKIDEBET' => 'Kredit yang diberikan',
            'KEWAJIBANSEGERA' => 'Kewajiban Segera',
            'DPKDEPOSITO' => 'Dana Pihak Ketiga Deposito',
            'DPKTABUNGAN' => 'Dana Pihak Ketiga Tabungan',
            'TABUNGANAB' => 'Simpanan dari Bank Lain dalam Bentuk Tabungan',
            'DEPOSITOAB3BULAN' => 'Simpanan Deposito dari Bank Lain Lebih dari 3 Bulan',
            'DEPOSITOABTOTAL' => 'Simpanan Deposito dari Bank Lain Total',
            'PINJAMANAB3BULAN' => 'Pinjaman yang Diterima dari Bank Lain Lebih dari 3 Bulan',
            'PINJAMANDPK3BULAN' => 'Pinjaman yang Diterima dari Pihak Ketiga bukan Bank Lebih dari 3 Bulan',
            'MODAL' => 'Modal Inti'
        ];
        $data = [];
        $results = [];

        foreach ($tags as $key => $label) {
            $saldo = H::analyticsAccountingTagSaldo($key, $end_date);
            $data[$key] = $saldo;
            $results[$label] = $saldo;
        }

        $rasio_cr = 0.00;
        $rasio_cr_aba = 0.00;
        $rasio_cr_div = $data['KEWAJIBANSEGERA'] + $data['DPKDEPOSITO'] + $data['DPKTABUNGAN'];
        if($rasio_cr_div > 0.00) {
            $rasio_cr = ($data['KAS'] + $data['ABAGIRO'] +
                        $data['ABATABUNGAN'] - $data['TABUNGANAB']) /
                        $rasio_cr_div;
            $rasio_cr_aba = ($data['KAS'] + $data['ABAGIRO'] +
                            $data['ABATABUNGAN'] - $data['TABUNGANAB']
                            + $data['ABADEPOSITO'] - $data['DEPOSITOABTOTAL']) /
                            $rasio_cr_div;
        }

        $rasio_ldr = 0.00;
        $rasio_ldr_div =    $data['DPKDEPOSITO'] + $data['DPKTABUNGAN'] +
                            $data['DEPOSITOAB3BULAN'] + $data['PINJAMANAB3BULAN'] +
                            $data['PINJAMANDPK3BULAN'] + $data['MODAL'];
        if($rasio_cr_div > 0.00) {
            $rasio_ldr = $data['BAKIDEBET'] / $rasio_ldr_div;
        }

        $results['Rasio CR'] = $rasio_cr;
        $results['Rasio CR * Net Antar Bank'] = $rasio_cr_aba;
        $results['Rasio LDR'] = $rasio_ldr;

        return $results;
    }



}
