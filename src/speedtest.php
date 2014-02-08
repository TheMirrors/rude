<?

namespace rude;

class speedtest
{
	public $function_name = '';

	public $time_start    = 0;
	public $time_end      = 0;

	public function time_current()
	{
		return microtime(true);
	}

	public function time_global()
	{
		return round((microtime(true) - $_SERVER['REQUEST_TIME_FLOAT']), 4);
	}

	public function start($function_name = '')
	{
		$this->function_name = $function_name;

		$this->time_start = $this->time_current();
	}

	public function end()
	{
		$this->time_end = $this->time_current();
	}

	public function result()
	{
		return round($this->time_end - $this->time_start, 4);
	}

	public function end_result()
	{
		$this->end();
		$this->result();
	}

	public function end_result_reset()
	{
		$this->end_result();
		$this->reset();
	}

	public function function_name()
	{
		return $this->function_name;
	}

	public function reset()
	{
		$this->time_start = 0;
		$this->time_end   = 0;
	}

	public function html_result()
	{
		?><pre>Выполнение функции <?= $this->function_name() ?> заняло <?= $this->result() ?> ms, всего с момента запуска страницы прошло <?= $this->time_global() ?> ms</pre><?

		flush();
	}

	public function html_end_result()
	{
		$this->end();
		$this->html_result();
	}

	public function html_end_result_reset()
	{
		$this->html_end_result();
		$this->reset();
	}
}

