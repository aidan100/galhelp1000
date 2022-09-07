def total_marks(input_text):
    lines = input_text.split("newline")
    lines.pop()

    total_marks = 0

    for val in lines:
        line_array = val.split(",")
        total_marks += int(line_array[1])

    return total_marks



