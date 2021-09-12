<?php




abstract class DotbForecasting_AbstractForecastArgs
{
    /**
     * @var array Rest Arguments
     */
    protected $args;

    /**
     * Class Constructor
     * @param array $args       Service Arguments
     */
    public function __construct($args)
    {
        $this->setArgs($args);
    }

    /**
     * Set the arguments
     *
     * @param array $args
     * @return DotbForecasting_AbstractForecast
     */
    public function setArgs($args)
    {
        $this->args = $args;

        return $this;
    }

    /**
     * Return the arguments array
     *
     * @return array
     */
    public function getArgs()
    {
        return $this->args;
    }

    /**
     * Get a specific Arg Value, If it doesn't exist return Empty
     *
     * @param $key
     * @return string
     */
    public function getArg($key)
    {
        return isset($this->args[$key]) ? $this->args[$key] : "";
    }

    /**
     * Set an Arg to track
     *
     * @param string $key
     * @param mixed $value
     * @return DotbForecasting_AbstractForecast
     */
    public function setArg($key, $value)
    {
        $this->args[$key] = $value;

        return $this;
    }

}