<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LoanQuotations;
use Illuminate\Support\Facades\Auth;

class LoanQuotationController extends Controller
{
    public function quotedCustomer(Request $request)
    {
        $data['quotations'] = LoanQuotations::Query()
        ->with(['loan_application'])->paginate(20);
        // return $data; 
        return view('admin.loan_applications.quotations',$data);
    }

    public function quoteAllOtherLoan(Request $request)
    {
        $data = $request->all();
        $fill = $this->quotedAllLoanData($request->all());
        $fill['apply_loan_id'] = '1';
        $fill['partner_id'] = '13'; // id of finance partner
        $fill['quoted_by'] = '13'; // id of loggedin finance partner user
        $quote = new LoanQuotations();
        $quote->fill($fill)->save();
        return $fill;
    }

    public function quotePropertyLand(Request $request)
    {
        $data = $request->all();
        $fill = $this->quotedPropertyLandData($data);
        $fill['apply_loan_id'] = '1';
        $fill['partner_id'] = '13'; // id of finance partner
        $fill['quoted_by'] = '13'; // id of loggedin finance partner user
        $quote = new LoanQuotations();
        $quote->fill($fill)->save();
        return $fill;
    }

    public function quoteInvoiceFinancing(Request $request)
    {
        $data = $request->all();
        $fill = $this->quotedInvoiceFinancingData($data);
        $fill['apply_loan_id'] = '1';
        $fill['partner_id'] = '13'; // id of finance partner
        $fill['quoted_by'] = '13'; // id of loggedin finance partner user
        $quote = new LoanQuotations();
        $quote->fill($fill)->save();
        return $fill;
    }

    public function quotedInvoiceFinancingData($data)
    {
        $quantum_interest = [
            'fixed_or_floating'=> '1', //1 for fixed, 2 for floating/variable
            'quantum'=> '2333',
            'fixed'=>[
                'interest'=> [
                    'value_type' => '1', //1 for p_a, 2 for p_m
                    'p_a'=>'23',
                    'p_m'=>'23',
                ],
                'reducing_type'=>'1', //1=Simple/Flat, 2=Reducing weekly, 3=Reducing monthly, 4=Reducing yearly
                'tenure'=> [
                    'years'=>'23',
                    'months'=>'2',
                ],
                'lock_in'=> [
                    'years'=>'23',
                    'months'=>'2',
                ],
            ],
            'floating'=>[
                'reference_rate'=>'SORA',
                'publicly_financial_indicator'=> "accept only letters",
                'current_value'=> "2",
                'months_if_any'=> "2",
                "month_p_a_or_spread"=>'1', //1=Month vise p.a, 2=spread
                "month_pa"=>[
                    [
                        'from_month'=> '1',
                        'to_month'=> '12',
                        'p_a'=> '2', //in percentage
                    ],
                    [
                        'from_month'=> '13',
                        'to_month'=> '24',
                        'p_a'=> '2', //in percentage
                    ]
                ],
                'spread'=>[
                    [
                        'spread_value'=>'12',
                        'p_a'=>'12' // current_value + the spread they enter is p_a
                    ],
                    [
                        'spread_value'=>'12',
                        'p_a'=>'12' // current_value + the spread they enter is p_a
                    ]
                ]
                
            ]
        ];

        $one_time_fee = [
            'value_type'=>'1', //1 for flat value, 2 for percentage, 3 if entered both
            'flat_value'=> '23','percentage'=> '3','which_higher'=>1
        ];
        $monthly_fee = [
            'value_type'=>1, //1 for flat value, 2 for percentage, 3 if entered both
            'flat_value'=> '23','percentage'=> '3','which_higher'=>1
        ];
        $annual_fee = [
            'value_type'=>1, //1 for flat value, 2 for percentage, 3 if entered both
            'flat_value'=> '23','percentage'=> '3','which_higher'=>1
        ];

        $legal_fee = ['range_from'=> '23','range_to'=> '344'];

        $if_insurance_required = [
            'value_type'=>1, //1 for flat value, 2 for percentage, 3 if entered both
            'range_value_from'=> '23','range_value_from'=> '344',
            'range_percentage_from'=> '23','range_percentage_from'=> '344',
            'which_higher'=>1
        ];
        $eir = [
            'value_type'=>1, //1 for p_a_percentage, 2 for p_a_percentage
            'p_a_percentage'=> '23','p_a_percentage'=> '344'
        ];

        $repayment = [
            'repayment_terms'=>'P+I',
            'deffered_after'=>'11', //months
            'balloon_on'=>'11', //months
            'amortized_period'=>'11', //months
            'remarks'=>'optional depends on cost',
            'personal_notepad'=>'optional depends on cost'
        ];
        $quote_validity = null;
        // return $fill;

        return array(
            "quantum_interest"=>$quantum_interest,
            "one_time_fee"=>$one_time_fee,
            "monthly_fee"=>$monthly_fee,
            "annual_fee"=>$annual_fee,
            "legal_fee"=>$legal_fee,
            "if_insurance_required"=>$if_insurance_required,
            "eir"=>$eir,
            "repayment"=>$repayment,
            "quote_validity"=>$quote_validity 
        );
    }

    public function quotedPropertyLandData($data)
    {
        $quantum_interest = [
            'fixed_or_floating'=> '1', //1 for fixed, 2 for floating/variable
            'quantum'=> '2333',
            'fixed'=>[
                'interest'=> [
                    'value_type' => '1', //1 for p_a, 2 for p_m
                    'p_a'=>'23',
                    'p_m'=>'23',
                ],
                'reducing_type'=>'1', //1=Simple/Flat, 2=Reducing weekly, 3=Reducing monthly, 4=Reducing yearly
                'tenure'=> [
                    'years'=>'23',
                    'months'=>'2',
                ],
                'lock_in'=> [
                    'years'=>'23',
                    'months'=>'2',
                ],
            ],
            'floating'=>[
                'reference_rate'=>'SORA',
                'publicly_financial_indicator'=> "accept only letters",
                'current_value'=> "2",
                'months_if_any'=> "2",
                "month_p_a_or_spread"=>'1', //1=Month vise p.a, 2=spread
                "month_pa"=>[
                    [
                        'from_month'=> '1',
                        'to_month'=> '12',
                        'p_a'=> '2', //in percentage
                    ],
                    [
                        'from_month'=> '13',
                        'to_month'=> '24',
                        'p_a'=> '2', //in percentage
                    ]
                ],
                'spread'=>[
                    [
                        'spread_value'=>'12',
                        'p_a'=>'12' // current_value + the spread they enter is p_a
                    ],
                    [
                        'spread_value'=>'12',
                        'p_a'=>'12' // current_value + the spread they enter is p_a
                    ]
                ]
                
            ]
        ];

        $one_time_fee = [
            'value_type'=>'1', //1 for flat value, 2 for percentage, 3 if entered both
            'flat_value'=> '23','percentage'=> '3','which_higher'=>1
        ];
        $monthly_fee = [
            'value_type'=>1, //1 for flat value, 2 for percentage, 3 if entered both
            'flat_value'=> '23','percentage'=> '3','which_higher'=>1
        ];
        $annual_fee = [
            'value_type'=>1, //1 for flat value, 2 for percentage, 3 if entered both
            'flat_value'=> '23','percentage'=> '3','which_higher'=>1
        ];

        $legal_fee = ['range_from'=> '23','range_to'=> '344'];

        $if_insurance_required = [
            'value_type'=>1, //1 for flat value, 2 for percentage, 3 if entered both
            'range_value_from'=> '23','range_value_from'=> '344',
            'range_percentage_from'=> '23','range_percentage_from'=> '344',
            'which_higher'=>1
        ];
        $eir = [
            'value_type'=>1, //1 for p_a_percentage, 2 for p_a_percentage
            'p_a_percentage'=> '23','p_a_percentage'=> '344'
        ];

        $repayment = [
            'repayment_terms'=>'P+I',
            'deffered_after'=>'11', //months
            'balloon_on'=>'11', //months
            'amortized_period'=>'11', //months
            'remarks'=>'optional depends on cost',
            'personal_notepad'=>'optional depends on cost'
        ];
        $quote_validity = null;
        // return $fill;

        return array(
            "quantum_interest"=>$quantum_interest,
            "one_time_fee"=>$one_time_fee,
            "monthly_fee"=>$monthly_fee,
            "annual_fee"=>$annual_fee,
            "legal_fee"=>$legal_fee,
            "if_insurance_required"=>$if_insurance_required,
            "eir"=>$eir,
            "repayment"=>$repayment,
            // "quote_validity"=>$quote_validity 
        );
    }

    protected function quotedAllLoanData($data){
        $quantum_interest = [
            'quantum'=> '2333',
            'interest_flat'=> [
                'p_a'=>'23',
                'p_m'=>'23',
            ],
            'interest_reducing_balance'=> [
                'p_a'=>'23',
                'p_m'=>'23',
            ],
            'interest_and_board_rate'=> [
                'interest_p_a'=>'23',
                'interest_p_a'=>'23',
            ],
            'flat_fee_regardless_tenure'=> [
                'falt_value'=>'23',
                'percentage'=>'23',
            ],
            'tenure'=> [
                'years'=>'23',
                'months'=>'2',
            ],
            'lock_in'=> [
                'years'=>'23',
                'months'=>'2',
            ],
        ];

        $one_time_fee = [
            'value_type'=>'1', //1 for flat value, 2 for percentage, 3 if entered both
            'flat_value'=> '23','percentage'=> '3','which_higher'=>1
        ];
        $monthly_fee = [
            'value_type'=>1, //1 for flat value, 2 for percentage, 3 if entered both
            'flat_value'=> '23','percentage'=> '3','which_higher'=>1
        ];
        $annual_fee = [
            'value_type'=>1, //1 for flat value, 2 for percentage, 3 if entered both
            'flat_value'=> '23','percentage'=> '3','which_higher'=>1
        ];

        $legal_fee = ['range_from'=> '23','range_to'=> '344'];

        $if_insurance_required = [
            'value_type'=>1, //1 for flat value, 2 for percentage, 3 if entered both
            'range_value_from'=> '23','range_value_from'=> '344',
            'range_percentage_from'=> '23','range_percentage_from'=> '344',
            'which_higher'=>1
        ];
        $eir = [
            'value_type'=>1, //1 for p_a_percentage, 2 for p_a_percentage
            'p_a_percentage'=> '23','p_a_percentage'=> '344'
        ];

        $repayment = [
            'repayment_terms'=>'P+I',
            'deffered_after'=>'11', //months
            'balloon_on'=>'11', //months
            'amortized_period'=>'11', //months
            'remarks'=>'optional depends on cost',
            'personal_notepad'=>'optional depends on cost'
        ];
        $quote_validity = null;
        // return $fill;

        return array(
            "quantum_interest"=>$quantum_interest,
            "one_time_fee"=>$one_time_fee,
            "monthly_fee"=>$monthly_fee,
            "annual_fee"=>$annual_fee,
            "legal_fee"=>$legal_fee,
            "if_insurance_required"=>$if_insurance_required,
            "eir"=>$eir,
            "repayment"=>$repayment,
            "quote_validity"=>$quote_validity 
        );
    }
}
