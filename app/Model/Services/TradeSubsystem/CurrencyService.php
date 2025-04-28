<?php 
namespace App\Model\Services\TradeSubsystem;
use App\Model\Contracts\Interfaces\Data\CurrencyRepositoryInterface;
use App\Model\Contracts\Interfaces\Data\TradePairRepositoryInterface;
use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\CurrencyFormatterInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\CurrencyServiceInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\UserServiceInterface;
use App\Model\Contracts\Interfaces\Services\Common\CurlServiceInterface;
use Illuminate\Http\Request;
class CurrencyService implements CurrencyServiceInterface
{
	protected $currencyFormatter;
	protected $currencyRepository;
	protected $tradePairRepository;
	protected $curlService;
	protected $userService;

	const BTC_USD_PAIR_ID = 1;

	public function __construct(CurrencyFormatterInterface $currencyFormatter,
								TradePairRepositoryInterface $tradePairRepository,
								CurlServiceInterface $curlService,
								UserServiceInterface $userService,
								CurrencyRepositoryInterface $currencyRepository) 
	{
		$this->currencyFormatter = $currencyFormatter;
		$this->currencyRepository = $currencyRepository;
		$this->tradePairRepository = $tradePairRepository;
		$this->curlService = $curlService;
		$this->userService = $userService;

    }	
		
	public function getCurrencyPairs()
	{
		$pairs = $this->tradePairRepository->enabled();
		return $this->currencyFormatter->prepareCurrenciesForTradePage($pairs);
	}
	public function getById($pairId)
	{
		$pair = $this->tradePairRepository->get($pairId);
		return $this->currencyFormatter->prepareCurrenciesForTradePage(collect([$pair]))[0];
	}
	public function updateCurrenciesRates()
	{
		$cryptoCurrencies = $this->currencyRepository->getCryptoCurrencies();
		$cryptoCurrenciesAcronyms = $cryptoCurrencies->pluck('acronym')->toArray();
		foreach($cryptoCurrenciesAcronyms as $index => $acronym)
		{
			if($acronym == 'DSH')
			{
				$cryptoCurrenciesAcronyms[$index] = 'DASH';
			}
		}
		$values = $this->curlService->getMultiPriceCurrencyRates(
			$this->currencyFormatter->prepareCurrenciesAcronymsForCurlRequest($cryptoCurrenciesAcronyms)
		);
		if($values)
		{
			foreach($values as $acronym => $value)
			{
				if($acronym == 'DASH')
				{
					$acronym = 'DSH';
				}
				$this->currencyRepository->updateUsdRate($acronym, $value['USD']);
			}
		}
	}
	
	public function updateCurrenciesRatesAverage()
	{

		$cryptoCurrencies = $this->currencyRepository->getCryptoCurrencies();
		$currencies = $cryptoCurrencies->pluck('acronym')->toArray();

		foreach($currencies as $index => $acronym)
		{

			if($acronym == 'DSH')
			{

				$currencies[$index] = 'DASH';

			}

		}
		
		foreach($currencies as $currency)
		{

			$values = $this->curlService->getCurrencyDayAverage($currency);

			try {

				if($values && array_key_exists('RAW', $values) && array_key_exists('OPEN24HOUR', $values['RAW']))
				{

					$this->currencyRepository->updateUsdRateAverage($currency, $values['RAW']['OPEN24HOUR']);
					
				}

			}catch(\Exception $e){}

		}

	}	

	public function getCurrentPair()
	{

		if(old('trade_pair_id')) 
		{

			return $this->getById(old('trade_pair_id'));

		}else{

			if(\Session::has('pairId')) 
			{ 

				return $this->getById(\Session::get('pairId'));
				
			}else{

				$this->userService->updateSavedPair(self::BTC_USD_PAIR_ID);
				
				return $this->getById(self::BTC_USD_PAIR_ID);

			}
			
		}

	}

}