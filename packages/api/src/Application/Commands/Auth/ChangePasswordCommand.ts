class ChangePasswordCommand {
  private readonly id: number;
  private readonly oldPassword: string;
  private readonly newPassword: string;
  constructor(id: number, oldPassword: string, newPassword: string) {
    this.id = id;
    this.oldPassword = oldPassword;
    this.newPassword = newPassword;
  }

  getId(): number {
    return this.id;
  }
  getOldPassword(): string {
    return this.oldPassword;
  }
  getNewPassword(): string {
    return this.newPassword;
  }
}

export default ChangePasswordCommand;
