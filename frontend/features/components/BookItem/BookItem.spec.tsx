import { act, fireEvent, render, screen, waitFor } from "@/common/utils/test-utils";
import { BookItem } from "./BookItem.component";
import { bookItem } from "./BookItem.mock";
import { createLoan } from "@/requests/loans/createLoan";
import { loanItem } from "../LoanItem/LoanItem.mock";

jest.mock('@/requests/loans/createLoan');
const mockCreateLoan = createLoan as jest.MockedFunction<typeof createLoan>;


describe("<BookItem />", () => {
  it("should render the title", () => {
    render(<BookItem {...bookItem} />);
    const titleElement = screen.getByText(bookItem.title);
    expect(titleElement).toBeInTheDocument();
  });

  it("should use the provided cover image", () => {
    const { debug } = render(<BookItem {...bookItem} coverUrl={bookItem.coverUrl} />);
    const imageElement = screen.getByRole("img", { name: bookItem.title });
    expect(imageElement).toHaveAttribute("style", `background-image: url(${bookItem.coverUrl});`);
  });

  it("should use the default cover image when no coverUrl is provided", () => {
    render(<BookItem {...bookItem} coverUrl={undefined} />);
    const imageElement = screen.getByRole("img", { name: bookItem.title });
    expect(imageElement).toHaveAttribute("style", "background-image: url(/cover.png);");
  });

  it("should render the loan button", () => {
    render(<BookItem {...bookItem} isAvailable={true} />);
    const buttonElement = screen.getByRole("button", { name: /Empréstimo/i });
    expect(buttonElement).toBeInTheDocument();
  });

  it("should render the loan button", () => {
    render(<BookItem {...bookItem} isAvailable={false} />);
    const buttonElement = screen.getByRole("button", { name: /Emprestado/i });
    expect(buttonElement).toBeInTheDocument();
  });

  it("should display the full title in a tooltip", async () => {
    render(<BookItem {...bookItem} />);
    const tooltipElement = screen.getByText(bookItem.title);
    expect(tooltipElement).toBeInTheDocument();
  });

  it("should render a description", () => {
    render(<BookItem {...bookItem} />);
    const descriptionElement = screen.getByText(/Lorem ipsum dolor sit amet, consectetur adipiscing elit./i);
    expect(descriptionElement).toBeInTheDocument();
  });

  it('should handle loan successfully', async () => {
    const createdLoan = { ...loanItem, book: { ...bookItem, isAvailable: false }  };
    mockCreateLoan.mockResolvedValueOnce(createdLoan);

    act(() => {
      render(<BookItem {...bookItem} />);
    });

    act(() => {
      fireEvent.click(screen.getByRole('button', { name: 'Empréstimo'}));
    });

    await waitFor(() => {
      expect(mockCreateLoan).toHaveBeenCalled();
      expect(mockCreateLoan).toHaveBeenCalledWith(bookItem.id);
      expect(screen.getByText('Empréstimo realizado! Prazo de 7 dias para devolução.')).toBeInTheDocument();
      expect(screen.queryByText('Empréstimo')).not.toBeInTheDocument();
      expect(screen.getByText('Emprestado')).toBeDisabled();
    });
  });

  it('should handle loan failure', async () => {
    mockCreateLoan.mockRejectedValueOnce(new Error('Failed to create loan'));

    act(() => {
      render(<BookItem {...bookItem} />);
    });

    act(() => {
      fireEvent.click(screen.getByRole('button', { name: 'Empréstimo'}));
    });;

    await waitFor(() => {
      expect(mockCreateLoan).toHaveBeenCalled();
      expect(mockCreateLoan).toHaveBeenCalledWith(bookItem.id);
      expect(screen.getByText('Erro ao realizar empréstimo. Tente novamente.')).toBeInTheDocument();
    });
  });
});
