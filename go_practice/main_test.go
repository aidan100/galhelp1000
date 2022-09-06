package main

import "testing"

func Test_calculateTotal(t *testing.T) {
	testString := "Programming,50newlineMath,12"
	want := (50 + 12)

	got, err := calculateTotal(testString)
	if err != nil {
		t.Errorf("calculateTotal() error = %v,", err)
		return
	}

	if got != want {
		t.Errorf("calculateTotal() = %v, want %v", got, want)
	}
}
