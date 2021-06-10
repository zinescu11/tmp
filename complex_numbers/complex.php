<?php
	final class Complex
	{
		function __construct(?float $real, ?float $image = null) {
			$this->real = $real ?: 0;
			$this->image = $image ?: 0;
		}

		function getReal(): float {
			return $this->real;
		}

		function getImage(): float {
			return $this->image;
		}

		function getModulus(): float {
			return sqrt($this->real * $this->real + $this->image * $this->image);
		}

		function plus(Complex $other): Complex {
			return new self($this->real + $other->real, $this->image + $other->image);
		}

		function minus(Complex $other): Complex {
			return new self($this->real - $other->real, $this->image - $other->image);
		}

		function mul(Complex $other): Complex {
			return new self($this->real * $other->real - $this->image * $other->image,
				$this->real * $other->image + $this->image * $other->real);
		}

		function div(Complex $other): Complex {
			$size = $other->real * $other->real + $other->image * $other->image;
			if ($size == 0) return new self(0);
			$real = ($this->real * $other->real + $this->image * $other->image) / $size;
			$image = ($this->image * $other->real - $this->real * $other->image) / $size;
			return new self($real, $image);
		}

		private float $real;
		private float $image;
	}




	//===test===

	assert((new Complex(1, 2))->plus(new Complex(2, 3)) == new Complex(3, 5));

	assert((new Complex(1, 2))->minus(new Complex(2, 3)) == new Complex(-1, -1));

	assert((new Complex(1, 2))->mul(new Complex(0)) == new Complex(0));

	assert((new Complex(1, 2))->div(new Complex(0)) == new Complex(0));

	assert((new Complex(2, 2))->div(new Complex(1, 1)) == new Complex(2, 0));

	print("Test passed");



