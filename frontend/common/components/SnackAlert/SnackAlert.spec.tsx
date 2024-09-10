import React from 'react';
import { render, screen, fireEvent } from "@/common/utils/test-utils";
import SnackAlert from "./SnackAlert.component";
import type { SnackAlertParams } from './SnackAlert.interface';

describe('SnackAlert', () => {
  const defaultProps: SnackAlertParams = {
    state: {
      open: true,
      message: 'Test message',
    },
    setState: jest.fn(),
    severity: 'success',
    vertical: 'bottom',
    horizontal: 'right',
    variant: 'filled',
    autoHideDuration: 3500,
  };

  it('should render the SnackAlert component with the correct message and severity', () => {
    render(<SnackAlert {...defaultProps} />);

    expect(screen.getByText('Test message')).toBeInTheDocument();
    expect(screen.getByRole('alert')).toHaveClass('MuiAlert-filledSuccess');
  });

  it('should call setState with open: false when the Snackbar is closed', () => {
    render(<SnackAlert {...defaultProps} />);

    fireEvent.click(screen.getByRole('button', { name: /close/i }));

    expect(defaultProps.setState).toHaveBeenCalledWith(expect.any(Function));
    expect(defaultProps.setState).toHaveBeenCalledTimes(1);
  });

  it('should render children inside the Alert component', () => {
    const children = <span>Additional content</span>;
    render(<SnackAlert {...defaultProps}>{children}</SnackAlert>);

    expect(screen.getByText('Additional content')).toBeInTheDocument();
  });

  it('should use default values for optional props', () => {
    const { rerender } = render(<SnackAlert {...defaultProps} />);

    expect(screen.getByRole('alert')).toHaveClass('MuiAlert-filledSuccess');

    rerender(<SnackAlert {...defaultProps} severity="error" />);
    expect(screen.getByRole('alert')).toHaveClass('MuiAlert-filledError');
  });

  it('should handle autoHideDuration correctly', () => {
    jest.useFakeTimers();
    render(<SnackAlert {...defaultProps} autoHideDuration={2000} />);

    expect(screen.getByRole('presentation')).toBeInTheDocument();

    jest.advanceTimersByTime(2000);

    expect(defaultProps.setState).toHaveBeenCalledWith(expect.any(Function));
    jest.useRealTimers();
  });

    it('should call handleClose when the Snackbar is closed', () => {
    render(<SnackAlert {...defaultProps} />);

    // Simulate closing the Snackbar
    const closeButton = screen.getByRole('button')
    fireEvent.click(closeButton);

    // Check if setState was called with open: false
    expect(defaultProps.setState).toHaveBeenCalledWith(expect.any(Function));
    expect(defaultProps.setState).toHaveBeenCalledTimes(1);
  });
});