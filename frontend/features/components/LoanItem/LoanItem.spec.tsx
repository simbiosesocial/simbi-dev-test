import { render, screen, act, fireEvent, waitFor } from "@/common/utils/test-utils";
import { LoanItem } from "./LoanItem.component";
import { loanItem } from "./LoanItem.mock";
import { renewLoan, finalizeLoan } from '@/requests/loans/updateLoan';
import { LoanStatus } from "@/declarations";

jest.mock('@/requests/loans/updateLoan');

const mockRenewLoan = renewLoan as jest.MockedFunction<typeof renewLoan>;
const mockFinalizeLoan = finalizeLoan as jest.MockedFunction<typeof finalizeLoan>;

describe("<LoanItem />", () => {  
  beforeEach(() => {
    mockRenewLoan.mockClear();
    mockFinalizeLoan.mockClear();
  });

  it("should render the title", () => {
    render(<LoanItem {...loanItem} />);
    const titleElement = screen.getByText(loanItem.book.title);
    expect(titleElement).toBeInTheDocument();
  });

  it("should use the provided cover image", () => {
    render(<LoanItem { ...loanItem }/>);
    const imageElement = screen.getByRole("img", { name: loanItem.book.title });
    expect(imageElement).toHaveAttribute("style", `background-image: url(${loanItem.book.coverUrl});`);
  });

  it("should use the default cover image when no coverUrl is provided", () => {
    render(<LoanItem {...loanItem} book={{
      ...loanItem.book,
      coverUrl: undefined
    }}/>);
    const imageElement = screen.getByRole("img", { name: loanItem.book.title });
    expect(imageElement).toHaveAttribute("style", "background-image: url(/cover.png);");
  });

  it("should render the loan buttons", () => {
    render(<LoanItem {...loanItem} />);
    const renewButton = screen.getByRole("button", { name: /Renovar/i });
    expect(renewButton).toBeInTheDocument();

    const finalizeButton = screen.getByRole("button", { name: /Devolver/i });
    expect(finalizeButton).toBeInTheDocument();
  });

  it("should display the full title in a tooltip", async () => {
    render(<LoanItem {...loanItem} />);
    const tooltipElement = screen.getByText(loanItem.book.title);
    expect(tooltipElement).toBeInTheDocument();
  });

  it('should handle loan renewal successfully', async () => {
    const updatedLoan = {...loanItem, status: 'active' as LoanStatus, returnDate: '2024-09-16T00:00:00+00:00' };
    mockRenewLoan.mockResolvedValueOnce(updatedLoan);

    act(() => {
      render(<LoanItem {...loanItem} />);
    });

    act(() => {
      fireEvent.click(screen.getByText('Renovar'));
    });

    await waitFor(() => {
      expect(mockRenewLoan).toHaveBeenCalled();
      expect(mockRenewLoan).toHaveBeenCalledWith(updatedLoan.id);
      expect(screen.getByText('Empréstimo renovado com sucesso!')).toBeInTheDocument();
      expect(screen.getByText('Data de devolução: 16/09/2024')).toBeInTheDocument();
      expect(screen.getByText(/Status: active/i)).toBeInTheDocument();
    });
  });

  it('should handle loan renewal failure', async () => {
    mockRenewLoan.mockRejectedValueOnce(new Error('Failed to renew loan'));

    act(() => {
      render(<LoanItem {...loanItem} />);
    });

    act(() => {
      fireEvent.click(screen.getByText('Renovar'));
    });;

    await waitFor(() => {
      expect(mockRenewLoan).toHaveBeenCalled();
      expect(mockRenewLoan).toHaveBeenCalledWith(loanItem.id);
      expect(screen.getByText('Erro ao renovar empréstimo. Tente novamente.')).toBeInTheDocument();
    });
  });

  it('should handle loan finalization successfully', async () => {
    const updatedLoan = {...loanItem, status: 'finished', returnedAt: '2024-09-09T00:00:00+00:00' };
    mockFinalizeLoan.mockResolvedValueOnce(updatedLoan);

    act(() => {
      render(<LoanItem {...loanItem} />);
    });

    act(() => {
      fireEvent.click(screen.getByText('Devolver'));
    });

    await waitFor(() => {
      expect(mockFinalizeLoan).toHaveBeenCalledWith(updatedLoan.id);
      expect(screen.getByText('Empréstimo finalizado com sucesso!')).toBeInTheDocument();
      expect(screen.getByText('Devolvido: 09/09/2024')).toBeInTheDocument();
      expect(screen.getByText('Status: finished')).toBeInTheDocument();

    });
  });

  it('should handle loan finalization failure', async () => {
    mockFinalizeLoan.mockRejectedValueOnce(new Error('Failed to finalize loan'));

    act(() => {
      render(<LoanItem {...loanItem} />);
    });

    act(() => {
      fireEvent.click(screen.getByText('Devolver'));
    });

    await waitFor(() => {
      expect(mockFinalizeLoan).toHaveBeenCalledWith(loanItem.id);
      expect(screen.getByText('Erro ao finalizar empréstimo. Tente novamente.')).toBeInTheDocument();
    });
  });

  it('should disable buttons when loan is finished', () => {
    const finishedProps = { ...loanItem, status: 'finished', returnedAt: '2024-06-09T00:00:00+00:00' };
    
    render(<LoanItem {...finishedProps} />);

    expect(screen.getByText('Renovar')).toBeDisabled();
    expect(screen.getByText('Devolver')).toBeDisabled();
  });

  it('should disable buttons when loading', async () => {
    
    act(() => {
      render(<LoanItem {...loanItem} />);
    });

    act(() => {
      fireEvent.click(screen.getByText('Renovar'));
    });
    
    expect(screen.queryByText('Renovar')).not.toBeInTheDocument();
    expect(screen.getByText('Processando...')).toBeDisabled();
    expect(screen.getByText('Devolver')).toBeDisabled();
  });
});
